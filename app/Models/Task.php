<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'completed', 'assigned_to', 'jobrole'];

    public function assignedTo()
    {
        return $this->belongsTo(Staff::class, 'assigned_to');
    }
}

