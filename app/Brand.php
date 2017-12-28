<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;

class Brand extends Model
{
    protected $fillable = ['name'];

    public function equipments()
    {
        $this->hasMany(Equipment::class);
    }
}
