<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbilityGroup extends Model
{
    use HasFactory;

    public function groupsAbilities()
    {
      return $this->hasMany('App\Models\GroupAbilities');
    }
}
