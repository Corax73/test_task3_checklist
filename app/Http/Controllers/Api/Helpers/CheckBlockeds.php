<?php

use App\Models\User;
use Illuminate\Http\Request;

if (! function_exists('checkBlockeds')) {

    /**
     * @param  int $user_id
     * 
     *@return bool
     */
    function checkBlockeds($user_id)
    {
        
        $user = User::find($user_id);

        if (!$user -> block == null) {
            
            if($user -> block -> blocking) {
                
                return true;
            
            } else {
                
                return false;
            
            }
        
        } else {

            return true;

        }

    }

}