<?php

use Illuminate\Http\Request;
use App\Models\User;

if (! function_exists('checkCountUsersChecklists')) {

    /**
     * @param  \Illuminate\Http\Request  $request
     * success response method.
     *@return \Illuminate\Http\Response
     */
    function checkCountUsersChecklists(Request $request)
    {
        
        $input1 = $request -> all();
        $user1 = User::find($input1['user_id']);
        $response1[] = $user1 -> checklists -> toArray();
        
        if(count($response1[0]) >= 5) {
            
            return true;
        
        } else {

            return false;

        }
    }
}