<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    // protected $fillable = ['task_id', 'user_id', 'status', 'rejection_reason'];
    // protected $table = 'task_status';
    // public function task()
    // {
    //     return $this->belongsTo(Task::class);
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
