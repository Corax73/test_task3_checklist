<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemChecklist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'checklist_id',
        'implementation',
    ];

    public function checklistId()
    {
        return $this -> hasOne(Checklist::class, 'id', 'checklist_id');
    }
}
