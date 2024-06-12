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

        $evaluations = Evaluation::with(['user', 'task'])->latest()->get();
        return view('admin/evaluation', compact('evaluations'));
    }

    public function addevaluation(Request $request){
        $user = User::find($request->fname);

        if ($user) {
            $tasks = $user->tasks;
        } else {
            $tasks = [];
        }
       
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
        $formattedPercentage = number_format($totalPercentage, 2);
        $performanceEvaluation->update([
            'total_average' => $formattedPercentage,
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

public function getEvaluationData($id) {
    $evaluation = Evaluation::with('user', 'task')->findOrFail($id);
    return response()->json([
        'staffName' => $evaluation->user->fname . ' ' . $evaluation->user->lname,
        'staffJobrole' => $evaluation->user->jobrole,
        'taskTitle' => $evaluation->task->title,
        'feedback' => $evaluation->feedback,
        'efficiency' => $evaluation->efficiency,
        'quality' => $evaluation->quality,
        'timeliness' => $evaluation->timeliness,
        'accuracy' => $evaluation->accuracy,
        'tardiness' => $evaluation->tardiness,
        'performanceAverage' => $evaluation->total_average,
        'date' => \Carbon\Carbon::parse($evaluation->created_at)->format('F j, Y')
    ]);
}


public function editevaluation($evaluation){

    $evaluation = Evaluation::with('user', 'task') // eager load user and task relationships
    ->findOrFail($evaluation);
    $staff = User::whereNotIn('usertype', ['admin', 'systemadmin'])->latest()->get();
    $task = Task::all();

    return view('admin.edit-evaluation', compact('evaluation','staff','task'));
}

public function updateevaluation(Request $request, $evaluation){

    $evaluation = Evaluation::findOrFail($evaluation);

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

    $evaluation->user_id = $request->user_id;
    $evaluation->task_id = $request->task_id;
    $evaluation->efficiency = $request->efficiency;
    $evaluation->quality = $request->quality;
    $evaluation->timeliness = $request->timeliness;
    $evaluation->accuracy = $request->accuracy;
    $evaluation->tardiness = $request->tardiness;
    $evaluation->feedback = $request->feedback;

    $totalRating = $evaluation->efficiency + $evaluation->quality + $evaluation->timeliness + $evaluation->accuracy + $evaluation->tardiness;
    $totalPercentage = ($totalRating / 25) * 100;

    if ($totalPercentage < 0 || $totalPercentage > 100) {
        throw new \Exception('Invalid total percentage value');
    }

    $evaluation->total_average = $totalPercentage;
    $evaluation->save();

    return redirect()->route('admin-evaluation')->with('success', 'Evaluation updated successfully!');

}

public function deleteMultipleRowseval(Request $request)
    {
        $ids = $request->input('ids');
        Evaluation::whereIn('id', explode(",",$ids))->delete();
        return response()->json(['status' => true, 'delete' => 'Selected Item Deleted']);
    }

public function destroyevaluation($evaluation){
    $evaluations = Evaluation::findOrFail($evaluation);
    $evaluations ->delete();

    return redirect()->route('admin-evaluation')->with('delete', 'Attendance Details Deleted');
}



public function userevaluation(){

    $user = auth()->user();

    $evaluations = $user->evaluation()->get();

    // $evaluations = $user->evaluation()->get();

    return view('evaluation', compact('evaluations'));
}

public function viewEvaluationData($id){

    $evaluation = Evaluation::with('user', 'task')->findOrFail($id);
    return response()->json([
        'staffName' => $evaluation->user->fname . ' ' . $evaluation->user->lname,
        'staffJobrole' => $evaluation->user->jobrole,
        'taskTitle' => $evaluation->task->title,
        'feedback' => $evaluation->feedback,
        'efficiency' => $evaluation->efficiency,
        'quality' => $evaluation->quality,
        'timeliness' => $evaluation->timeliness,
        'accuracy' => $evaluation->accuracy,
        'tardiness' => $evaluation->tardiness,
        'performanceAverage' => $evaluation->total_average,
        'date' => \Carbon\Carbon::parse($evaluation->created_at)->format('F j, Y')
    ]);

}


}
