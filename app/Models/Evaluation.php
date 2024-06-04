<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id', 'task_id', 'efficiency', 'quality','timeliness', 'accuracy', 'tardiness', 'total_average', 'feedback'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
