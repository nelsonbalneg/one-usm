<?php

namespace App\Http\Controllers\Student;

use File;
use App\Models\User;
use App\Models\SchoolName;
use Illuminate\Http\Request;
use App\Trait\ImageUploadTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentdetails = User::where("id", Auth::user()->id)->first();
        // Ensure empty strings for NULL values to avoid issues in JavaScript
        $studentdetails->region = $studentdetails->region ?? '';
        $studentdetails->province = $studentdetails->province ?? '';
        $studentdetails->city = $studentdetails->city ?? '';
        $studentdetails->brgy = $studentdetails->brgy ?? '';

        return view("student.profile.profile", compact('studentdetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if ($request->lrn == '000000000000') {
            $request->validate(
                [

                    'track' => ['required', 'string', 'max:100'],
                    'school_id' => ['required'],
                    'school_name' => ['required'],
                    'school_address' => ['required'],
                    'region_text' => ['required'],
                    'province_text' => ['required'],
                    'city_text' => ['required'],
                    'barangay_text' => ['required'],

                ]
            );
        } else {
            $request->validate(
                [
                    'lrn' => ['required', 'size:12', 'unique:users,lrn'],
                    'track' => ['required', 'string', 'max:100'],
                    'school_id' => ['required'],
                    'school_name' => ['required'],
                    'school_address' => ['required'],
                    'region_text' => ['required'],
                    'province_text' => ['required'],
                    'city_text' => ['required'],
                    'barangay_text' => ['required'],

                ],
                [
                    'lrn.size' => 'The LRN must be exactly 12 digits.',
                    'lrn.unique' => 'The LRN has already been taken.'
                ]
            );
            // validation

        }


        $user = User::findOrFail($id);

        $user->lrn = trim($request->lrn);
        $user->track = trim($request->track);
        $user->schoolid = trim($request->school_id);
        $user->shs_school = trim($request->school_name);
        $user->school_address = trim($request->school_address);
        $user->region = trim($request->region_text);
        $user->province = trim($request->province_text);
        $user->city = trim($request->city_text);
        $user->brgy = trim($request->barangay_text);
        $user->street = trim($request->street);
        $user->zipcode = trim($request->zipcode);

        // // Handle photo upload
        // $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
        // $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return redirect()->back()->with('message', 'Your profile has been successfully updated! To reserve a slot, please go to the RESERVATION menu.');
    }

    public function uploadPhoto(Request $request)
    {
        // validation
        $request->validate(
            [
                'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:5120'],

            ]
        );

        $user = User::findOrFail($request->id);

        // Handle photo upload
        $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
        $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return redirect()->back()->with('message', 'Your Profile Photo has been updated!');
    }

    public function school_name(Request $request): JsonResponse
    {
        // Check if 'schoolid' is provided in the request
        if ($request->has('schoolid')) {
            // Fetch records where 'schoolid' matches the provided value
            $schools = SchoolName::where('schoolid', $request->input('schoolid'))->get();
        } else {
            // Fetch all records if 'schoolid' is not provided
            $schools = SchoolName::all();
        }

        // Return the results in JSON format
        return response()->json($schools);
    }

    public function getLrn(Request $request): JsonResponse
    {
        if ($request->has('lrn')) {
            // Check if a record exists where 'lrn' matches the provided value
            $exists = User::where('lrn', $request->input('lrn'))->exists();

            return response()->json(['exists' => $exists]);
        }

        // If 'lrn' is not provided, return false by default
        return response()->json(['exists' => false]);
    }


    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Path to Tesseract executable (update if located elsewhere)
        $tesseractPath = '/usr/bin/tesseract';

        // Corrected: Ensure Tesseract path exists or handle accordingly
        $tesseractPath = '/usr/bin/tesseract';
        if (!file_exists($tesseractPath)) {
            return response()->json([
                'success' => false,
                'error' => 'Tesseract executable not found at the specified path.',
            ]);
        }

        // Corrected: Temporarily store the uploaded file with a unique name in the system's temporary directory
        $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(sys_get_temp_dir(), basename($tempFilePath));

        // Corrected: Use escapeshellarg to prevent command injection
        //$command = escapeshellarg($tesseractPath) . ' ' . escapeshellarg($tempFilePath) . ' stdout 2>&1';
        $command = 'timeout 60s ' . escapeshellarg($tesseractPath) . ' ' . escapeshellarg($tempFilePath) . ' stdout 2>&1';
        $output = shell_exec($command);

        // Clean up the temporary file after running OCR
        if (file_exists($tempFilePath)) {
            unlink($tempFilePath);
        }

        $twelveDigitNumber = null;
        $sixDigitNumber = null;

        // Match both 12-digit and 6-digit patterns separately
        if (preg_match('/\b\d{12}\b/', $output, $twelveDigitMatch)) {
            $twelveDigitNumber = $twelveDigitMatch[0];
        }

        if (preg_match('/\b\d{6}\b/', $output, $sixDigitMatch)) {
            $sixDigitNumber = $sixDigitMatch[0];
        }

        if ($twelveDigitNumber || $sixDigitNumber) {
            return response()->json([
                'success' => true,
                'text' => $output,
                'twelve_digit_number' => $twelveDigitNumber,
                'six_digit_number' => $sixDigitNumber,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'No LRN found in the image.',
                'text' => $output,
            ]);
        }
    }
    // public function upload(Request $request)
    // {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $tesseractPath = '/usr/bin/tesseract';
    //     if (!file_exists($tesseractPath)) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => 'Tesseract executable not found at the specified path.',
    //         ]);
    //     }

    //     // Create a temporary file path for the uploaded image
    //     $tempFilePath = sys_get_temp_dir() . '/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
    //     $request->file('image')->move(sys_get_temp_dir(), basename($tempFilePath));

    //     // Create a temporary file path for the text output
    //     $tempTextFilePath = sys_get_temp_dir() . '/' . uniqid() . '.txt';

    //     // Prepare the command to run Tesseract and output to the text file
    //     $command = sprintf('%s %s %s', escapeshellarg($tesseractPath), escapeshellarg($tempFilePath), escapeshellarg($tempTextFilePath));
    //     $process = proc_open($command, [], $pipes);

    //     try {
    //         if (is_resource($process)) {
    //             // Wait for the process to finish and get the return code
    //             $returnCode = proc_close($process);

    //             // Check if Tesseract completed successfully
    //             if ($returnCode === 0 && file_exists($tempTextFilePath)) {
    //                 $output = file_get_contents($tempTextFilePath);
    //             } else {
    //                 $output = '';
    //             }
    //         }
    //     } finally {
    //         // Ensure the temporary files are deleted after processing
    //         if (file_exists($tempFilePath)) {
    //             unlink($tempFilePath);
    //         }
    //         if (file_exists($tempTextFilePath)) {
    //             unlink($tempTextFilePath);
    //         }
    //     }

    //     $twelveDigitNumber = null;
    //     $sixDigitNumber = null;

    //     // Match both 12-digit and 6-digit patterns separately
    //     if (preg_match('/\b\d{12}\b/', $output, $twelveDigitMatch)) {
    //         $twelveDigitNumber = $twelveDigitMatch[0];
    //     }

    //     if (preg_match('/\b\d{6}\b/', $output, $sixDigitMatch)) {
    //         $sixDigitNumber = $sixDigitMatch[0];
    //     }

    //     if ($twelveDigitNumber || $sixDigitNumber) {
    //         return response()->json([
    //             'success' => true,
    //             'text' => $output,
    //             'twelve_digit_number' => $twelveDigitNumber,
    //             'six_digit_number' => $sixDigitNumber,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'error' => 'No LRN found in the image.',
    //             'text' => $output,
    //         ]);
    //     }
    // }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
