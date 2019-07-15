<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class ProfileController extends Controller
{
    public function index()
    {
        $roles  = Role::all();
        return $roles;
    }
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('profile.edit',compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $old_pass = $user->password;
        $input = $request->all();
        if(!Hash::check($input['password'],$old_pass))
        {
            $input['password'] = bcrypt($input['password']);
        }

        $user->update($input);
        return redirect()->route('home');
    }
}
