<?php

namespace App\Http\Controllers;

use App\User;
use App\Route;
use App\Run;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteRunsController extends Controller
{
	public function store($route_id)
	{
		Auth::user()->authenticateAdmin();

		$attributes = request()->validate([
    		'start_time' => ['required'],
    		'operator_id' => ['required'],
    		'vehicle_id' => ['required'],
    	]);

    	$sql = 'INSERT INTO runs (route_id, start_time, admin_id, operator_id, vehicle_id) values (?, ?, ?, ?, ?)';
		$fields = [$route_id, request('start_time'), Auth::user()->id, request('operator_id'), request('vehicle_id')];
		DB::insert($sql, $fields);

		return redirect('/routes/' . $route_id);
	}

	public function destroy($route_id, $id) {
		Auth::user()->authenticateAdmin();

		$sql = 'DELETE FROM runs WHERE id = ' . $id;
		DB::delete($sql);
		
		return redirect('/routes/' . $route_id);
	}
}