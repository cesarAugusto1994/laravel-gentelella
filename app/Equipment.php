<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Warehouse;
use App\Status;
use App\Models;

class Equipment extends Model
{
    const STATUS_DISPONIVEL = 1;
    const STATUS_RESERVADO = 2;
    const STATUS_EM_USO = 3;
    const STATUS_TRIAGEM = 4;
    const STATUS_DESCARTE = 5;

    protected $table = 'equipments';

    protected $fillable = [
        "name",
        "warehouse_id",
        "model_id",
        "active_code",
        "serial",
        "date",
        "status_id",
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function models()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
