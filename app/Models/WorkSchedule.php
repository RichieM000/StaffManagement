<?php

// app/Models/WorkSchedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    use HasFactory;

    protected $table = 'work_schedules';

    protected $fillable = ['staff_id', 'day_of_week', 'start_time', 'end_time'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}

