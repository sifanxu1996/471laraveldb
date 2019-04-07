<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Route extends Model
{
	// inverse of protected
    protected $guarded = [];

    public function addRun($attributes) {
    	Run::create([
			'route_id' => $this->id,
			'time' => $attributes['time'],
			'admin_id' => Auth::user()->id,
			'operator_id' => $attributes['operator_id'],
			'vehicle_id' => $attributes['vehicle_id'],
		]);
    }

    public function runs()
    {
    	return $this->hasMany(Run::class);
    }

    public function route_leg()
    {
    	return $this->hasMany(Route_leg::class);
    }
}
