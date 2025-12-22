<?php

namespace App\Http\Controllers\Utdc;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class UTDCCeeSlipController extends Controller
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
        // Retrieve the current authenticated user details
        $studentdetails = Auth::user();

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


        // Create the QR code
        $qrCode = new QrCode($qrData);

        // Create a PNG writer
        $writer = new PngWriter();

        // Generate the QR code image and encode it as a string
        $qrImage = $writer->write($qrCode)->getString();

        // Encode the QR code image to base64
        $base64QrCode = base64_encode($qrImage);

        $photoUrl = "http://172.16.0.43/uploads/" . basename($cee_reservation->photo);
        $compressedPhotoPath = $this->fetchAndCompressPhoto($photoUrl);

        // Encode the compressed photo for inline use in the PDF
        $compressedPhotoBase64 = base64_encode(file_get_contents($compressedPhotoPath));

        // Pass the base64 QR code string to the view for inclusion in the PDF
        $pdf = PDF::loadView('utdc.cee-slip.exam-slip', compact('cee_reservation', 'base64QrCode', 'compressedPhotoBase64'))
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        // Stream the PDF instead of downloading it
        return $pdf->stream("{$cee_reservation->app_no}-usmcee-slip.pdf");
    }
}
