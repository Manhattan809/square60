<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = User::find(Auth::user()->id)->first();

        return view('dashboard/profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
    	$user = User::find(Auth::user()->id);

    	$validatedData = $request->validate([
	        'name' => 'required',
	        'email' => (($user->email !== $request->get('email')) ? 'required|unique:users,email' : ''),
	        'password' => (($user->password !== $request->get('password')) ? 'required|confirmed' : ''),
	        'password_confirmation' => (($user->password !== $request->get('password')) ? 'required' : ''),
	    ]);

    	$user->name = $request->get('name');
    	$user->email = $request->get('email');
    	if ($user->password !== $request->get('password'))
    		$user->password = bcrypt($request->get('password'));
    	$user->save();

        return redirect('dashboard/profile');
    }
}
