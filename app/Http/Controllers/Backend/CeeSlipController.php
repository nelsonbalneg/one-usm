<?php

namespace App\Http\Controllers\Backend;

use FPDF;
use App\Mail\SlipEmail;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Endroid\QrCode\Color\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Endroid\QrCode\RoundBlockSizeMode;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\ErrorCorrectionLevel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CeeSlipController extends Controller
{

    public function fetchAndCompressPhoto($photoUrl)
    {
        $photoName = basename($photoUrl);
        $compressedPhotoPath = public_path("uploads/compressed/" . $photoName);

        // Check if the compressed photo already exists
        if (file_exists($compressedPhotoPath)) {
            return $compressedPhotoPath;
        }

        // Fetch the image from the URL
        $response = Http::get($photoUrl);
        if ($response->ok()) {
            $imageData = $response->body();

            // Create image resource from the fetched data
            $image = imagecreatefromstring($imageData);

            // Compress and save the image locally
            imagejpeg($image, $compressedPhotoPath, 40);
            imagedestroy($image); // Free memory

            return $compressedPhotoPath;
        }

        // Return a placeholder if the image cannot be fetched
        return public_path('uploads/placeholder.png');
    }

    public function generateceeExamSlip(Request $request)
    {
        $app_no = Crypt::decryptString($request->app_no);

        $cee_reservation = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->where('reservations.app_no', $app_no)
            ->select(
                'reservations.user_id',
                'reservations.app_no',
                'reservations.firstpriorty_desc',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.is_repeat_exam',
                'rooms.room_name',
                'rooms.college_name',
                'rooms.campus',
                'rooms.exam_session',
                'rooms.time',
                'rooms.schedule',
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.email',
                'users.suffix',
                'users.sex',
                'users.phone',
                'users.photo',
                'users.birthdate',
                'rooms.map_file',
            )
            ->first();

        // Generate QR code with app_no, firstname, and lastname
        $qrData = $cee_reservation->app_no . ',' . $cee_reservation->firstname . ' ';

        if (!empty($cee_reservation->middlename)) {
            $qrData .= $cee_reservation->middlename . ' ';
        }

        $qrData .= $cee_reservation->lastname;


        // Create a PNG writer
        $writer = new PngWriter();

        $qrCode = new QrCode(
            data: $qrData,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $writer->write($qrCode);


        $qrFilePath = 'qrcodes/' . $cee_reservation->app_no . '.png';
        Storage::disk('public')->put($qrFilePath, contents: $result->getString());

        $qrCodeUrl = storage_path('app/public/' . $qrFilePath);

        $photoUrl = "http://172.16.0.43/uploads/" . basename($cee_reservation->photo);
        // $compressedPhotoPath = $this->fetchAndCompressPhoto($photoUrl);

        // Encode the compressed photo for inline use in the PDF
        //  $compressedPhotoBase64 = base64_encode(file_get_contents($compressedPhotoPath));

        // Pass the base64 QR code string to the view for inclusion in the PDF
        $pdf = PDF::loadView('admin.cee-slip.exam-slip', compact('cee_reservation', 'qrCodeUrl'))
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        // Stream the PDF instead of downloading it
        return $pdf->stream("{$cee_reservation->app_no}-usmcee-slip.pdf");
    }

    public function generateceeExamSlipforEmail(Request $request)
    {

        $cee_reservation = DB::table('reservations')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->where('reservations.app_no', $request->app_no)
            ->select(
                'reservations.user_id',
                'reservations.app_no',
                'reservations.firstpriorty_desc',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.is_repeat_exam',
                'rooms.room_name',
                'rooms.college_name',
                'rooms.campus',
                'rooms.exam_session',
                'rooms.time',
                'rooms.schedule',
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.email',
                'users.suffix',
                'users.sex',
                'users.phone',
                'users.photo',
                'users.birthdate'
            )
            ->first();

        // Generate QR code with app_no, firstname, and lastname
        $qrData = $cee_reservation->app_no . ',' . $cee_reservation->firstname . ' ';

        if (!empty($cee_reservation->middlename)) {
            $qrData .= $cee_reservation->middlename . ' ';
        }

        $qrData .= $cee_reservation->lastname;


        // Create a PNG writer
        $writer = new PngWriter();

        $qrCode = new QrCode(
            data: $qrData,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $writer->write($qrCode);


        $qrFilePath = 'qrcodes/' . $cee_reservation->app_no . '.png';
        Storage::disk('public')->put($qrFilePath, contents: $result->getString());

        $qrCodeUrl = storage_path('app/public/' . $qrFilePath);

        $photoUrl = "http://172.16.0.43/uploads/" . basename($cee_reservation->photo);

        // Pass the base64 QR code string to the view for inclusion in the PDF
        $pdf = PDF::loadView('admin.cee-slip.exam-slip', compact('cee_reservation', 'qrCodeUrl'))
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        // Save the PDF to a temporary location
        $filePath = storage_path("app/public/{$cee_reservation->app_no}-usmcee-slip.pdf");

        $pdf->save($filePath);

        return $filePath;
    }

    public function sendExamSlipEmail(Request $request)
    {
        try {

            $filePath = $this->generateceeExamSlipforEmail($request);

            $cee_reservation = DB::table('reservations')
                ->join('users', 'reservations.user_id', '=', 'users.id')
                ->where('reservations.app_no', $request->app_no)
                ->select('users.email', 'users.firstname', 'users.lastname')
                ->first();

            $details = [
                'email' => mb_convert_encoding($cee_reservation->email, 'UTF-8', 'auto'),
                'name' => mb_convert_encoding("{$cee_reservation->firstname} {$cee_reservation->lastname}", 'UTF-8', 'auto'),
            ];

            Mail::to($details['email'])->queue(new SlipEmail($details, $filePath));

            return response()->json(['message' => 'Exam slip email sent successfully.']);

        } catch (\Exception $e) {

            Log::error('Failed to send exam slip email.', [
                'app_no' => $request->app_no,
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json(['message' => 'Failed to send email.'], 500);
        }
    }



}
