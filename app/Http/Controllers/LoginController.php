<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\UsersGroup;
use App\Models\Groupmembership;

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
            
            if(UsersGroup::find($checkUser -> membershipID -> usersgroup_id) -> name == 'SuperAdmin') {

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
            
            if(isset($user -> membershipID -> usersgroup_id)) {
                
                $idGroup = $user -> membershipID -> usersgroup_id;
                
                $usergroup = UsersGroup::find($idGroup) -> toArray();
                
                $usersGroupNames[$user -> id] = $usergroup['name'];
            
            } else {
                
                $usersGroupNames[$user -> id] = 'No';
            
            }
        
        }

        $groupNames = UsersGroup::all();
        
        for ($i = 0; $i < count($groupNames); $i++) {

            $names[$i] = $groupNames[$i]['name'];

        }

        return view('layouts.dashboard', [
            'users' => $users,
            'usersGroupNames' => $usersGroupNames,
            'names' => $names
        ]);

    }

    public function logout()
    {

        Auth::logout();
        
        return redirect('/');

    }

    public function changeGroup($id, Request $request)
    {

        $selectionGroup = $request ->  only('selection_group');

        $user = User::find($id);

        $group = UsersGroup::where('name', $selectionGroup) -> first();

        $newGroupId['usersgroup_id'] = $group -> id;

        $user -> update($newGroupId);

        $membership['user_id'] = $user -> id;
        $membership['usersgroup_id'] = $group -> id;

        if($groupmember = Groupmembership::where('user_id', $user -> id) -> first()) {

            $groupmember = Groupmembership::where('user_id', $user -> id) -> first();
            $groupmember -> update(['usersgroup_id' => $group -> id]);

        } else {
            
            $groupmember = Groupmembership::create($membership);

        }

        return redirect('/dashboard');

    }
}
