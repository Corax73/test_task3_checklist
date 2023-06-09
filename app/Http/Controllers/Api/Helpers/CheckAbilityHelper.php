<?php

use App\Models\User;
use App\Models\UsersGroup;
use App\Models\GroupAbilities;
use Illuminate\Support\Facades\Auth;

if (! function_exists('checkAbility')) {

    /**
     * @param  int $numberAbility
     * success response method.
     *@return bool
     */
    function checkAbility($numberAbility)
    {
        
        $user = Auth::user();
        if(!($user -> membershipID)) {

            return false;

        } else {
        
        $groupAbilities = GroupAbilities::where('usersgroup_id', $user -> membershipID -> usersgroup_id) -> get();
        $groupAbilities = $groupAbilities -> toArray();
        
        for ($i = 0; $i < count($groupAbilities); $i++) {

            $abilityGroup[$i] = $groupAbilities[$i]['abilitygroup_id'];

        }
        
        if (in_array($numberAbility, $abilityGroup)) {

            return true;

        } else {

            return false;

        }

    }
    }
}