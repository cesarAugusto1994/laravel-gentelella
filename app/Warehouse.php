<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;

class Warehouse extends Model
{
    protected $fillable = ['name', 'city', 'state'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function equipments()
    {
        $this->hasMany(Equipment::class);
    }
}
