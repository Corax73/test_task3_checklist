<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id'
    ];

    public function whoUser()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function items()
    {
		return $this->hasMany('App\Models\ItemChecklist');
	}
}
