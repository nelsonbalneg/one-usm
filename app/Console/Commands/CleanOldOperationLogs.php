<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanOldOperationLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-old-operation-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateThreshold = Carbon::now()->subMonths(4);

        $deletedCount = DB::table('operation_logs')
            ->where('created_at', '<', $dateThreshold)
            ->delete();

        $this->info("Deleted {$deletedCount} old operation log entries.");

        return 0;
    }
}
