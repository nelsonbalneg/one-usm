<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Schedule::command('telescope:prune --hours=48')->daily();
Schedule::command('app:clean-old-telescope-data')->daily();

// Clean operation logs older than 8 months - daily at 3 AM
// Schedule::command('app:clean-old-operation-logs')->dailyAt('03:00');
Schedule::command('app:clean-old-operation-logs')->hourly();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
