<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

class AnalystController extends Controller
{
    public function index()
	{
		$sql = 'SELECT * FROM routes';
		$routes = DB::select($sql);

		return view('analyst.index', compact('routes'));
    }
    
    public function show($id)
    {
        $sql = 'SELECT * FROM routes WHERE id = ' . $id;
		$route = collect(DB::select($sql))->first();

		$sql = 'SELECT * FROM runs r, vehicles v WHERE v.id = r.vehicle_id AND r.route_id = ' . $id;
		$runs = DB::select($sql);

		$sql = 'SELECT * FROM route_legs WHERE route_id = ' . $id;
		$route_legs = DB::select($sql);

		$sql = 'SELECT * FROM stops';
		$stops = DB::select($sql);

		return view('analyst.show', compact('route', 'runs', 'route_legs', 'stops'));
    }
}
