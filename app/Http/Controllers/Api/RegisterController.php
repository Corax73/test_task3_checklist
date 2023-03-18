<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validData = Validator::make($request -> all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validData -> fails()){

            return sendError('Validation Error.', $validData -> errors());
        
        }
        
        $inputData = $request -> all();
        $inputData['password'] = bcrypt($inputData['password']);

        $user = User::create($inputData);

        $success['token'] =  $user -> createToken('MyApp') -> accessToken;
        $success['name'] =  $user -> name;

        return sendResponse($success, 'User register successfully.');
    }


}
