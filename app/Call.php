<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\CallSubjects;

class Call extends Model
{
    public function subject()
    {
        return $this->belongsTo(CallSubjects::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipemnts()
    {
        return $this->hasMany(Equipment::class);
    }
}
