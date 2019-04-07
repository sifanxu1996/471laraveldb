<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
	// inverse of protected
    protected $guarded = [];

	public function route()
	{
		return $this->belongsTo(Route::class);
	}

	public function operator()
	{
		return $this->belongsTo(Operator::class);
	}
}
