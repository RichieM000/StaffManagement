<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Schedule the login history cleanup command
Artisan::command('login-history:clear', function () {
    $this->info('Clearing login histories older than 24 hours...');
    // Your logic to delete login histories here
})->daily();

Artisan::command('tasks:update-status', function () {
    $this->info('Update the status of tasks based on their deadlines');
    // Your logic to delete login histories here
})->daily();