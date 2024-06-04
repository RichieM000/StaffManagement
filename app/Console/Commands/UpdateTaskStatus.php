<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class UpdateTaskStatus extends Command
{
    protected $signature = 'tasks:update-status';
    protected $description = 'Update the status of tasks based on their deadlines';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tasks = Task::where('status', 'pending')->get();

        foreach ($tasks as $task) {
            if (Carbon::now()->greaterThan(Carbon::parse($task->deadline))) {
                $task->status = 'exceeded deadline';
                $task->save();
            }
        }

        $this->info('Task statuses have been updated.');
    }
}

