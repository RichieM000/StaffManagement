<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'leave_type', 'start_date', 'end_date', 'reason', 'status'];

//     public function scopeFilter($query, array $filters)
// {
//     // $query->when($filters['tag'] ?? false, function ($query, $tag) {
//     //     $query->whereHas('user', function ($q) use ($tag) {
//     //         $q->where('fname', $tag);
//     //     });
//     // });

//     $query->when($filters['search'] ?? false, function ($query, $search) {
//         $query->where(function ($q) use ($search) {
//             $q->whereHas('user', function ($q) use ($search) {
//                 $q->where('fname', 'like', "%{$search}%");
//             })->orWhere('leave_type', 'like', "%{$search}%")
//               ->orWhere('reason', 'like', "%{$search}%")
//               ->orWhere('jobrole', 'like', "%{$search}%");
//         });
//     });
// }


    public function user(){
        return $this->belongsTo(User::class);
    }
}
