<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index()
    {
        return view('layouts.login');
    }

    public function auth(Request $request)
    {
        $input = $request -> only('email', 'password');
        
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator -> fails()){
                
            return view('layouts.login');
        
        }

        if (Auth::attempt($input)) {

            $checkUser = User::where('email', $input['email']) -> first();
            
            if ($checkUser -> usersgroup -> name == 'SuperAdmin') {

                Auth::once($input);
                return redirect('/dashboard');

            }

            return redirect('/');

        }

        return view('layouts.login');
    }

    public function users()
    {

        $users = User::all();

        foreach ($users as $key => $user) {

            $usersGroupNames[$user -> id] = isset($user -> usersgroup -> name) ? $user -> usersgroup -> name : 'No';

        }

        return view('layouts.dashboard', [
            'users' => $users,
            'usersGroupNames' => $usersGroupNames
        ]);

    }

    public function logout()
    {
        Auth::logout();
        
        return redirect('/');

    }
}
