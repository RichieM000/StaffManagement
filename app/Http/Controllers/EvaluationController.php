<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{
    public function index(){

        $evaluations = Evaluation::with(['user', 'task'])->get();
        return view('admin/evaluation', compact('evaluations'));
    }

    public function addevaluation(){
        $tasks = Task::all();
        $staff = User::whereNotIn('usertype', ['admin', 'systemadmin'])->latest()->get();
        return view('admin/add-evaluation', compact('tasks','staff'));
    }



    public function store(Request $request){

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
            'efficiency' => 'required|in:1,2,3,4,5',
            'quality' => 'required|in:1,2,3,4,5',
            'timeliness' => 'required|in:1,2,3,4,5',
            'accuracy' => 'required|in:1,2,3,4,5',
            'tardiness' => 'required|in:1,2,3,4,5',
            'feedback' => 'nullable|string|max:255',
        ]);

        $performanceEvaluation = Evaluation::create([
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
            'efficiency' => $request->efficiency,
            'quality' => $request->quality,
            'timeliness' => $request->timeliness,
            'accuracy' => $request->accuracy,
            'tardiness' => $request->tardiness,
            'feedback' => $request->feedback,
            'total_average' => 0,
        ]);
    
        $totalRating = $performanceEvaluation->efficiency + $performanceEvaluation->quality + $performanceEvaluation->timeliness + $performanceEvaluation->accuracy + $performanceEvaluation->tardiness;
        $totalPercentage = ($totalRating / 25) * 100;
    
        if ($totalPercentage < 0 || $totalPercentage > 100) {
            throw new \Exception('Invalid total percentage value');
        }
    
        $performanceEvaluation->update([
            'total_average' => $totalPercentage,
        ]);
    
        return redirect()->route('admin-evaluation')->with('success', 'Rating submitted successfully!');

    }


    public function fetchTasks($userId)
{
    // Fetch tasks assigned to the specified user
    $tasks = Task::where('assigned_to', $userId)->get();

    // Return tasks as JSON response
    return response()->json($tasks);
}


}
