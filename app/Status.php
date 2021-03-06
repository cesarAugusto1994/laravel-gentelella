<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = ['name'];

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}
