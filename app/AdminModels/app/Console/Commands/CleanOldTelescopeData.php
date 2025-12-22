<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanOldTelescopeData extends Command
{
    protected $signature = 'app:clean-old-telescope-data';
    protected $description = 'Delete Telescope entries older than 5 days';

    public function handle()
    {
         $this->info("Starting full Telescope cleanup...");

        // Delete all entries
        $deleted = DB::table('telescope_entries')->delete();

        $this->info("Deleted {$deleted} Telescope entries (tags deleted automatically via cascade).");
        $this->info("Cleanup completed!");

    }
}
