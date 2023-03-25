<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupmembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'usersgroup_id'
    ];
}
