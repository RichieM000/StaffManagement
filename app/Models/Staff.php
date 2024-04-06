<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Staff extends User implements Sortable
{
    use HasFactory;
    protected $table = 'staff';
    protected $fillable = ['firstname', 'lastname', 'gender', 'age', 'address', 'jobrole', 'email', 'phone'];

    public function workSchedules()
    {
        return $this->hasMany(WorkSchedule::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'staff_task');
    }

   
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['search']) && $filters['search']) {
            $query->where(function ($query) use ($filters) {
                $query->where('firstname', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('lastname', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('gender', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('age', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('address', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('jobrole', 'like', '%' . $filters['search'] . '%')
                      ;
                // Add more fields to search if needed
            });
        }
        return $query;
    }

   // Staff.php (or your Staff model file)

   use SortableTrait;

   public $sortable = [
       'order_column_name' => 'order',
       'sort_when_creating' => true,
   ];

//    public function assignedTask()
//     {
//         return $this->belongsTo(Task::class, 'assigned_task_id');
//     }

    // public function tasks()
    // {
    //     return $this->belongsToMany(Task::class);
    // }
   
}