<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Workout;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function dashboard()
    {
        return view('administrator.dashboard');
    }
    public function profile()
    {
        return view('administrator.profile');
    }
    public function workouts()
    {
        $exercise = Workout::all();
        return view('administrator.workouts', compact('exercise'));
    }
    public function meeting()
    {
        $meeting=Meeting::all();
        return view('administrator.meeting',compact('meeting'));
    }
    public function exercise()
    {
        return view('administrator.exercise');
    }
    public function exercisestore(Request $request)
    {
        $request->validate([
            'exerciseName' => 'required|max:255',
            'exerciseDescription' => 'required|max:255',
        ]);

        // Store the data in the database
        Workout::create([
            'name' => $request->exerciseName,
            'description' => $request->exerciseDescription,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Exercise added successfully!');
    }
    public function logoutShow()
    {
        return view('administrator.logout');
    }
}
