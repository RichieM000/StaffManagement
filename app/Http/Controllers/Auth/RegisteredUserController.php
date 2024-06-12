<?php

namespace App\Http\Controllers\Auth;

use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;
use App\Models\TaskStatus;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'age' => 'required|string|max:3',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'jobrole' => 'required|string|max:255',
            'committee_roles' => 'array',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => 'nullable|string|max:11|min:11',
            'password' => ['required', 'confirmed', 'min:6', Rules\Password::defaults()],
            'day_of_week' => 'required|string|max:255', // Add validation for day_of_week
            'start_time' => 'required|string|max:8', // Add validation for start_time (adjust as needed)
            'end_time' => 'required|string|max:8',
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);

        $user = User::create($userData);

        
   // check if the selected job role is kagawad
   if($validatedData['jobrole'] === 'Kagawad' && $request->has('committee_roles')){
    $user->kagawad_committee_on = implode(',', $request->committee_roles);
    
    $user->save();
}

if($user->kagawad_committee_on === null){

    $user->kagawad_committee_on = "None";

    $user->save();
}

// Simplified Laravel code

// // Find tasks based on user's jobrole or committee roles
// $tasks = Task::where('jobrole', $user->jobrole)
//     ->orWhereIn('jobrole', explode(',', $user->kagawad_committee_on))
//     ->get();

// // Assign tasks to the user
// foreach ($tasks as $task) {
//     // Create TaskStatus if task committee role matches user's kagawad_committee_on
//     if ($task->kagawad_committee_on === $user->kagawad_committee_on) {
//         TaskStatus::create([
//             'task_id' => $task->id,
//             'user_id' => $user->id,
//             'status' => 'pending',
//         ]);
//     }
// }

        WorkSchedule::create([
            'user_id' => $user->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

     

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('admin.staff')->with('success', 'Staff Registered Successfully');
    }
}
