<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\LoginHistory;

class ClearLoginHistory extends Command
{
    protected $signature = 'login-history:clear';
    protected $description = 'Clear login histories older than 24 hours';

    public function handle()
    {
        $yesterday = Carbon::now()->subDay();
        LoginHistory::where('created_at', '<', $yesterday)->delete();
        $this->info('Login histories older than 24 hours have been cleared.');
    }
}
