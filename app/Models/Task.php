<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'description', 'deadline', 'file_path', 'jobrole', 'assigned_to', 'status','rejected_reason'];
    protected $dates = ['deadline'];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function jobRoles()
    {
        return explode(',', $this->jobrole);
    }

//     public function pendingTasks()
// {
//     $tasks = Task::where('status', 'pending')->latest()->get();

//     return view('admin.tasks.pending', compact('tasks'));
// }

    public function user()
{
    return $this->belongsToMany(User::class, 'assigned_to');
}


public function users()
{
    return $this->belongsTo(User::class);
}

public function taskStatus()
{
    return $this->hasMany(TaskStatus::class);
}
public function evaluation(){
    return $this->hasMany(Evaluation::class);
}
}