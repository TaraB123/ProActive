<?php

namespace App\Http\Controllers;
use App\User;
use App\Activity;



use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($user_id)
    {   

        $user = User::findOrFail($user_id); 
        $activities = $user->activities;
        
        $registered = $user->registered; 
        
        $activity = $user->activities->first(); 
        $register = $user->registered->first(); 
        return view('profile.show', compact('user', 'activities', 'registered', 'activity', 'register')); 

    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('profile.edit', compact('user'));
    }

    public function update($user_id, Request $request){

        $user = User::findOrFail($user_id);

        $user->name = $request->input('name');
        $user->description = $request->input('description');

        $user->save();

        return redirect('/profile/' . $user->id);
    }

}
