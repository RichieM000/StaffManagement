<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'clock_in', 'clock_out','duration'];
    protected $dates = ['date'];

    // Define the user attendance relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userid()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
