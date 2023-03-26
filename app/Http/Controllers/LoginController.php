<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\UsersGroup;
use App\Models\Groupmembership;
use App\Models\CountCheclistsForUser;
use App\Models\Checklist;

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
                
                $usersGroupNames[$user -> id] = 'No set';
            
            }
        
        }

        $groupNames = UsersGroup::all();
        
        for ($i = 0; $i < count($groupNames); $i++) {

            $names[$i] = $groupNames[$i]['name'];

        }

        return view('layouts.manage', [
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

    public function change($id, Request $request)
    {
        switch ($request -> input('action')) {

            case 'Change':
                
                $selectionGroup = $request ->  only('selection_group');
                
                $group = UsersGroup::where('name', $selectionGroup) -> first();
                
                $membership['user_id'] = $id;
                $membership['usersgroup_id'] = $group -> id;
                
                if($groupmember = Groupmembership::where('user_id', $id) -> first()) {
                    
                    $groupmember = Groupmembership::where('user_id', $id) -> first();
                    
                    $groupmember -> update(['usersgroup_id' => $group -> id]);
                
                } else {
                    
                    $groupmember = Groupmembership::create($membership);
                
                }
                
                break;

            case 'Set max':

                if ($data = $request -> validate ([
                    'max' => 'required',
                ],
                [
                    'max.required' => 'Max is required',
                    'max.integer' => 'Max is not integer'
                ])) {
                    
                    $data['user_id'] = $id;
                    
                    if($max = CountCheclistsForUser::where('user_id', $id) -> first()) {
                        
                        $max -> update($data);
                    
                    } else {
                        
                        $setMax = CountCheclistsForUser::create($data);
                    
                    }
                
                break;
            }
        }

        return redirect('/dashboard');

    }

    public function checklists(Request $request)
    {

        $checklists = Checklist::where('user_id', $request -> user_id) -> get();
        
        return view('layouts.checklists', [
            'checklists' => $checklists
        ]);
    }

    public function listChecklists(Request $request)
    {

        $checklists = Checklist::where('id', $request -> id) -> first();
        $items = $checklists -> items;
        
        return view('layouts.listChecklist', [
            'items' => $items
        ]);
        
    }
}
