<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usersgroup_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function membershipId()
    {
        return $this -> hasOne(Groupmembership::class, 'user_id', 'id');
    }

    public function block()
    {
        return $this -> hasOne(Blocked::class, 'user_id', 'id');
    }

    public function max()
    {
        return $this -> hasOne(CountCheclistsForUser::class, 'user_id', 'id');
    }

    public function checklists()
    {
		return $this -> hasMany('App\Models\Checklist');
	}

}
