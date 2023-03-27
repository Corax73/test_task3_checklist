<?php

use Illuminate\Http\Request;
use App\Models\User;

if (! function_exists('checkCountUsersChecklists')) {

    /**
     * @param  \Illuminate\Http\Request  $request
     * success response method.
     *@return bool
     */
    function checkCountUsersChecklists(Request $request)
    {
        
        $input1 = $request -> all();
        $user1 = User::find($input1['user_id']);
        $response1[] = $user1 -> checklists -> toArray();

        if(!$user1 -> max == null) {

            if(count($response1[0]) >= $user1 -> max -> max) {

                return true;
            
            } else {
                
                return false;
            
            }
        } else {
            
            return true;
        
        }
    }
}