<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $jobroles = Staff::select('jobrole')->distinct()->orderBy('jobrole')->pluck('jobrole')->toArray(); 
    
        $staffData = Staff::orderBy('firstname')->get(); // Sort staff by firstname alphabetically
    
        return view('admin.teams', compact('jobroles', 'staffData'));
    }
}