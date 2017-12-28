<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Status;

class Equipment extends Model
{
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

    	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest', ['except' => 'logout']);
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
