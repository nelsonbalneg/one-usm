<?php

namespace App\Jobs;

use App\Models\MikroTikRequest;
use App\Services\MikroTikService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateMikroTikAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $student_no;
    protected $password;
    protected $semester;

    public function __construct($student_no, $password, $semester)
    {
        $this->student_no = $student_no;
        $this->password = $password;
        $this->semester = $semester;
    }

    public function handle(MikroTikService $mikrotik)
    {
        $server = 'hotspot2';
        $profile = 'U-Students';

        // CREATE USER IN MIKROTIK
        $mikrotik->addHotspotUser(
            $server,
            $this->student_no,
            $this->password,
            $profile
        );

        // SAVE RECORD IN DATABASE
        MikroTikRequest::create([
            'student_no' => $this->student_no,
            'password' => $this->password,
            'semester' => $this->semester,
        ]);
    }
}
