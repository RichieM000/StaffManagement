<?php

// app/Models/WorkSchedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    use HasFactory;

    protected $table = 'work_schedules';

    protected $fillable = ['staff_id', 'user_id', 'day_of_week', 'start_time', 'end_time'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attendance(){
        return $this->belongsTo(Attendance::class, 'user_id');
    }
}

