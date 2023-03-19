<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAbilities extends Model
{
    use HasFactory;

    protected $fillable = [
        'abilitygroup_id',
    ];
    public function getAbilities()
    {
      return $this -> belongsTo('App\Models\UsersGroup');
    }
}
