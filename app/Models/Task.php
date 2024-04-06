<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'completed', 'jobrole', 'assigned_to'];
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

    public function users()
{
    return $this->belongsToMany(User::class, 'staff_task');
}
}



