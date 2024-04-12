<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// TaskJobRole.php

class TaskJobRole extends Model
{
    protected $fillable = ['task_id', 'job_role', 'status', 'rejection_reason'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

