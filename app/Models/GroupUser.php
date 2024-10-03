<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'user_id',
    ];

    // Relationship to the group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Relationship to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
