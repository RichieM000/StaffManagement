<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $jobroles = User::select('jobrole')->distinct()->orderBy('jobrole')->pluck('jobrole')->toArray(); 
    
        // Filter out users with usertype 'admin'
        $staffData = User::where('usertype', '!=', 'admin')->orderBy('fname')->get(); // Sort staff by firstname alphabetically
    
        return view('admin.teams', compact('jobroles', 'staffData'));
    }
}