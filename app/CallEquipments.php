<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
use App\Call;

class CallEquipments extends Model
{
    public function call()
    {
        return $this->belongsTo(Call::class, 'call_id');
    }

    public function equipments()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
