<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Status;

class Equipment extends Model
{
    const STATUS_DISPONIVEL = 1;
    const STATUS_RESERVADO = 2;
    const STATUS_EM_USO = 3;
    const STATUS_TRIAGEM = 4;
    const STATUS_QUEBRADO = 5;
    
    protected $table = 'equipments';

    protected $fillable = [
        "name",
        "brand_id",
        "model",
        "active_code",
        "serial",
        "date",
        "status_id",
    ];
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function call()
    {
        return $this->belongsTo(Call::class);
    }
}
