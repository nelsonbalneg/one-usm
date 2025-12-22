<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConfirmReservationController extends Controller
{
    public function confirmationStatus(Request $request)
    {
        // Retrieve JSON data from the request
        $data = $request->json()->all();

        // Check if no data is received
        if (empty($data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data received in the request.',
            ], 400);
        }

        // Validate the JSON input
        $validator = Validator::make($data, [
            '*.classname' => 'required|string',
            '*.schoolyear' => 'required|string',
            '*.employeeid' => 'required|string',
            '*.employeename' => 'required|string',
            '*.studentno' => 'required|string',
            '*.studentname' => 'required|string',
            '*.date' => 'required|date',
            '*.time' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input data',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            foreach ($data as $entry) {
                // Check if the record already exists
                $exists = DB::table('scan_data_logs')
                    ->where('studentno', $entry['studentno'])
                    ->where('employeeid', $entry['employeeid'])
                    ->whereDate('date', $entry['date'])
                    ->exists();

                // Insert only if it does not exist
                if (!$exists) {
                    DB::table('scan_data_logs')->insert([
                        'classname' => $entry['classname'],
                        'schoolyear' => $entry['schoolyear'],
                        'employeeid' => $entry['employeeid'],
                        'employeename' => $entry['employeename'],
                        'studentno' => $entry['studentno'],
                        'studentname' => $entry['studentname'],
                        'date' => $entry['date'],
                        'time' => $entry['time'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Update reservation status in the database
                DB::table('reservations')
                    ->where('app_no', $entry['studentno'])
                    ->update([
                        'status' => 'confirmed',
                        'updated_at' => now(),
                    ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Scan data logs updated successfully, and reservations updated.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
