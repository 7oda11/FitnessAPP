<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Trainer;
use App\Models\TrainerUser;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Builder\Trait_;

class UserController extends Controller
{
    public function regiserLoading()
    {
        return view('auth.register-loading');
    }
    public function dashboard()
    {
        return view('user.dashboard');
    }
    public function profile()
    {
        return view('user.profile');
    }
    public function showProfile()
    {
        return view('user.edit-profile');
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

        $user = auth()->user(); // assuming the authenticated user is the trainer
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->location = $request->location;
        $user->phone = $request->phone;
        $user->weight = $request->weight;
        $user->height = $request->height;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
    public function workouts()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Fetch the workouts for the authenticated user
        $workouts = Workout::where('user_id', $user->id)->get();

        // Get unique trainers from the workouts
        $exercise = $workouts->pluck('trainer')->unique('id');
        // dd($exercise);

        // Return the view with the unique trainers
        return view('user.workouts', compact('exercise'));
    }
    public function getAllExercises($id)
    {
        $exercises = Workout::where('user_id', auth()->user()->id)->where('trainer_id', $id)->get();
        $trainer = Trainer::where('id', $id)->first();
        return view('user.exercises', compact('exercises', 'trainer'));
    }
    public function meeting()
    {
        $meetings = Meeting::where('user_id', auth()->user()->id)
            ->get();
        return view('user.meeting', compact('meetings'));
    }
    public function scheduled()
    {
        $meetings = Meeting::where('user_id', auth()->user()->id)
            ->get();
        return view('user.scheduled-meetings', compact('meetings'));
    }
    public function unscheduled($id)
    {
        $meeting = Meeting::find($id);
        if (!$meeting) {
            return redirect()->back()->with('error', 'Meeting not found');
        }
        $meeting->user_id = null;
        $meeting->save();
        return redirect()->back()->with('success', 'Meeting unscheduled successfully!');
    }

    public function showMeeting($id)
    {
        $meet = Meeting::where('id', $id)->first();
        return view('user.show-meeting', compact('meet'));
    }
    public function assignMeeting($id)
    {
        $meet = Meeting::find($id);
        $meet->user_id = auth()->user()->id;
        $meet->save();
        return redirect()->route('user.meeting')->with('success', 'Meeting assigned successfully!');
    }
    public function Trainers()
    {
        // Assuming you have authenticated the user and have their ID
        $userId = auth()->id();

        // Fetch the user with the associated trainers
        $user = User::with('trainers')->find($userId);

        // Get the IDs of trainers the user is already registered with
        $registeredTrainerIds = $user->trainers->pluck('id')->toArray();

        // Fetch all trainers excluding those already registered with the user
        $availableTrainers = Trainer::whereNotIn('id', $registeredTrainerIds)->get();

        return view('user.triners', compact('availableTrainers'));
    }
    public function showtriner($id)
    {
        $num = TrainerUser::where('trainer_id', $id)->count();
        $trainer = Trainer::where('id', $id)->first();
        return view('user.showtriner', compact('trainer', 'num'));
    }
    public function registertriner($id)
    {
        $user = User::find(auth()->user()->id);
        $trainer = Trainer::find($id);
        $user->trainers()->attach($trainer->id);
        return redirect()->route('user.profile')->with('success', 'Trainer assigned successfully!');
    }
    public function registertriners()
    {
        $user = User::find(auth()->user()->id);
        return view('user.registertriners', compact('user'));
    }
    public function showRegistertriner($id)
    {
        $num = TrainerUser::where('trainer_id', $id)->count();
        $trainer = Trainer::where('id', $id)->first();
        return view('user.shiw-register-trainers', compact('trainer', 'num'));
    }
    public function unregistertriner($id)
    {
        // Handle meetings
        $meetings = Meeting::where('trainer_id', $id)->where('user_id', auth()->user()->id)->get();
        foreach ($meetings as $meeting) {
            $meeting->user_id = null;
            $meeting->save();
            $meeting->delete();
        }
        $workouts = Workout::where('trainer_id', $id)->where('user_id', auth()->user()->id)->get();
        foreach ($workouts as $workout) {
            $workout->delete();
        }
        $user = User::find(auth()->user()->id);
        $trainer = Trainer::find($id);
        if ($user && $trainer) {
            $user->trainers()->detach($trainer->id);
        }

        return redirect()->route('user.profile')->with('success', 'Trainer unassigned successfully!');
    }
    public function chatbot()
    {
        return view('user.chatbot');
    }
    public function logoutShow()
    {
        return view('user.logout');
    }
}
