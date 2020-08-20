<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{   public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view ('profile.show');
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('welcome.edit', compact('user'));
    }

    public function update($user_id, Request $request){

        $user = User::findOrFail($user_id);

        $user->description = $request->input('description');

        $user->save();

        return redirect('/');
    }

}
