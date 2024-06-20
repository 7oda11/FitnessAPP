<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Trainer;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{
    public function dashboard()
    {
        return view('trainer.dashboard');
    }
    public function profile()
    {
        return view('trainer.profile');
    }
    public function showProfile()
    {
        return view('trainer.edit-profile');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|max:255',
            'password' => 'nullable|min:8|confirmed',
            'gender' => 'required',
            'age' => 'required|integer|min:0',
            'location' => 'required|max:255',
            'phone' => 'required|max:15',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ]);

        $trainer = auth()->user(); // assuming the authenticated user is the trainer
        $trainer->name = $request->name;
        $trainer->email = $request->email;
        $trainer->username = $request->username;

        if ($request->password) {
            $trainer->password = Hash::make($request->password);
        }

        $trainer->gender = $request->gender;
        $trainer->age = $request->age;
        $trainer->location = $request->location;
        $trainer->phone = $request->phone;
        $trainer->weight = $request->weight;
        $trainer->height = $request->height;
        $trainer->save();

        return back()->with('success', 'Profile updated successfully!');
    }
    public function workouts()
    {

        // Fetch the workouts for the authenticated user
        $workouts = Workout::where('trainer_id', auth()->guard('trainer')->user()->id)->get();
        // Get unique trainers from the workouts
        $exercise = $workouts->pluck('user')->unique('id');
        // dd($exercise);
        // $exercise = Workout::where('trainer_id', auth()->guard('trainer')->user()->id)->get();
        return view('trainer.workouts', compact('exercise'));
    }
    public function showEditExercises($id)
    {
        $excercise = Workout::where('id', $id)->first();
        $trainer = auth()->guard('trainer')->user();
        return view('trainer.edit-exercise', compact('excercise', 'trainer'));
    }
    public function editExercises(Request $request, $id)
    {
        $request->validate([
            'exerciseName' => 'required|string|max:255',
            'exerciseDescription' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        // Find the exercise by ID
        $exercise = Workout::findOrFail($id);

        // Update the exercise attributes
        $exercise->name = $request->exerciseName;
        $exercise->description = $request->exerciseDescription;
        $exercise->user_id = $request->user_id;
        $exercise->trainer_id = auth()->guard('trainer')->user()->id;

        // Save the updated exercise
        $exercise->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Exercise updated successfully!');
    }
    public function deleteExercises($id)
    {
        $exercise = Workout::findOrFail($id);

        // Delete the exercise
        $exercise->delete();

        // Redirect with success message
        return redirect()->back()->with('success', 'Exercise deleted successfully!');
    }
    public function meeting()
    {
        $meetings = Meeting::where('trainer_id', auth()->guard('trainer')->user()->id)->get();
        // dd($meetings);

        return view('trainer.meeting', compact('meetings'));
    }
    public function formCreateMeeting()
    {
        $trainer = auth()->guard('trainer')->user();
        return view('trainer.create-meeting', compact('trainer'));
    }
    public function createMeeting(Request $request)
    {
        $request->validate([
            'MeetinLink' => 'required|url',
            'MeetingTime' => 'required', 'user_id' => 'required|exists:users,id',


        ]);
        $meeting = new Meeting();
        $meeting->user_id = $request->user_id;
        $meeting->meeting_link = $request->MeetinLink;
        $meeting->meeting_time = $request->MeetingTime;
        $meeting->trainer_id = auth()->guard('trainer')->user()->id;
        $meeting->save();
        return redirect()->back()->with('success', 'Meeting link added successfully!');
    }
    public function showExerciseForm()
    {
        $trainer = auth()->guard('trainer')->user();
        return view('trainer.excercise', compact('trainer'));
    }
    public function exercises(Request $request)
    {
        $request->validate([
            'exerciseName' => 'required|string|max:255',
            'exerciseDescription' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create the exercise (assuming you have an Exercise model)
        Workout::create([
            'name' => $request->exerciseName,
            'description' => $request->exerciseDescription,
            'user_id' => $request->user_id,
            'trainer_id' => auth()->guard('trainer')->user()->id,
        ]);

        return redirect()->back()->with('success', 'Exercise added successfully!');
    }
    public function showExercises($id)
    {
        $workout = Workout::where('trainer_id', auth()->guard('trainer')->user()->id)->where('user_id', $id)->get();
        return view('trainer.show-exercise', compact('workout'));
    }
    public function showMeeting($id)
    {
        $meet = Meeting::where('id', $id)->first();
        return view('trainer.show-meeting', compact('meet'));
    }
    public function showEditMeeting($id)
    {
        $trainer = auth()->guard('trainer')->user();
        $meet = Meeting::where('id', $id)->first();
        return view('trainer.show-edit-meeting', compact('meet','trainer'));
    }
    public function editMeeting(Request $request, $id)
    {
        $request->validate([
            'MeetinLink' => 'required|url',
            'MeetingTime' => 'required',
            'user_id' => 'required|exists:users,id',


        ]);
        
        $meeting = Meeting::find($id);
        $meeting->user_id = $request->user_id;
        $meeting->meeting_link = $request->MeetinLink;
        $meeting->meeting_time = $request->MeetingTime;
        $meeting->trainer_id = auth()->guard('trainer')->user()->id;
        $meeting->save();
        return redirect()->back()->with('success', 'Meeting link added successfully!');
    }
    public function deleteMeeting($id)
    {
        $meeting = Meeting::find($id);
        // if ($meeting->user_id) {
        //     return redirect()->back()->withErrors(['error' => 'Meeting cannot be deleted']);
        // }
        $meeting->user_id = null;
        $meeting->save();
        $meeting->delete();
        return redirect()->route('trainer.meeting')->with('success', 'Meeting deleted successfully!');
    }
    public function chatbot()
    {
        return view('trainer.chatbot');
    }
    public function logoutShow()
    {
        return view('trainer.logout');
    }
}
