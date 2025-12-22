<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;

class FetchProgramPolicies implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $termId;
    protected $realCampusId;
    protected $cacheKey;



    public function __construct($termId, $realCampusId, $cacheKey)
    {
        $this->termId = $termId;
        $this->realCampusId = $realCampusId;
        $this->cacheKey = $cacheKey;
    }


    public function handle()
    {
        try {
            $response = Http::timeout(10)->get("http://172.16.0.60/academic/api/v2/ProgramPolicies/list/term/{$this->termId}/realcampus/{$this->realCampusId}");


            $data = $response->successful() ? $response->json() : null;
            Cache::put($this->cacheKey, $data, now()->addHour());


        } catch (\Exception $e) {
            // Handle the error as needed (e.g., retry, store error information).
        } finally {
            Cache::forget("{$this->cacheKey}_fetching");
            Cache::put("{$this->cacheKey}_fetched_at", now());
        }
    }
}
