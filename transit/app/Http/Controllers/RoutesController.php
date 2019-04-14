<?php

namespace App\Http\Controllers;

use App\User;
use App\Route;
use App\Run;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutesController extends Controller
{
	public function index()
	{
		$sql = 'SELECT * FROM routes';
		$routes = DB::select($sql);

		return view('routes.index', compact('routes'));
	}

	public function create()
	{
		Auth::user()->authenticateAdmin();

		$sql = 'SELECT * FROM stops';
		$stops = DB::select($sql);

		return view('routes.create', compact('stops'));
	}

	public function store()
	{
		Auth::user()->authenticateAdmin();

		request()->validate([
			'id' => ['required'],
			'name' => ['required', 'min:2', 'max:255'],
			'start_stop_id' => ['required', 'different:end_stop_id'],
			'end_stop_id' => ['required', 'different:start_stop_id'],
		]);

		$sql = 'INSERT INTO routes (id, name, start_stop_id, end_stop_id) values (?, ?, ?, ?)';
		$fields = [request('id'), request('name'), request('start_stop_id'), request('end_stop_id')];

		DB::insert($sql, $fields);

		return redirect('/routes');
	}

	public function show($id)
	{
		$sql = 'SELECT * FROM routes WHERE id = ' . $id;
		$route = collect(DB::select($sql))->first();

		$sql = 'SELECT * FROM runs WHERE route_id = ' . $id;
		$runs = DB::select($sql);

		$sql = 'SELECT * FROM route_legs WHERE route_id = ' . $id . ' ORDER BY start_stop_id';
		$route_legs = DB::select($sql);

		$sql = 'SELECT * FROM stops';
		$stops = DB::select($sql);

		$sql = 'SELECT * FROM employees e, users u WHERE e.user_id = u.id AND u.role = "operator"';
		$operators = DB::select($sql);

		$sql = 'SELECT * FROM vehicles';
		$vehicles = DB::select($sql);

		return view('routes.show', compact('route', 'runs', 'route_legs', 'stops', 'operators', 'vehicles'));
	}

	public function edit($id)
	{
		Auth::user()->authenticateAdmin();

		$sql = 'SELECT * FROM routes WHERE id = ' . $id;
		$route = collect(DB::select($sql))->first();

		return view('routes.edit', compact('route'));
	}

	public function assign($id)
	{
		Auth::user()->authenticateAdmin();

		$sql = 'SELECT * FROM routes WHERE id = ' . $id;
		$route = collect(DB::select($sql))->first();

		$sql = 'SELECT * FROM stops';
		$stops = DB::select($sql);

		return view('/routes.assign', compact('route', 'stops'));
	}

	public function assignStore($id)
	{
		Auth::user()->authenticateAdmin();

		$attributes = request()->validate([
    		'start_stop_id' => ['required', 'different:end_stop_id'],
    		'end_stop_id' => ['required', 'different:start_stop_id'],
    		'duration' => ['required'],
    	]);

		$sql = 'SELECT * FROM route_legs WHERE route_legs.route_id = ' .$id;
		$route_legs = DB::select($sql);
		
		if(!empty($route_legs)) {
			foreach ($route_legs as $routeleg ) {
				if ($routeleg->start_stop_id==request('start_stop_id') || $routeleg->end_stop_id==request('end_stop_id')) dd('Route leg already exists.');
			}
		}
		
		/* 
		echo "<script type=\"text/javascript\"> window.alert('Edit route after adding new route leg!');
		window.location.href = '/index.html'; </script>";
		*/

		$sql = 'INSERT INTO route_legs (route_id, start_stop_id, end_stop_id, duration) VALUES (?, ?, ?, ?)';
		$fields = [$id, request('start_stop_id'), request('end_stop_id'), request('duration')];
		DB::insert($sql, $fields);

		return redirect('/routes/' . $id);
	}

	public function update($id)
	{
		Auth::user()->authenticateAdmin();

		$sql = 'UPDATE routes SET id = ?, name = ?, start_stop_id = ?, end_stop_id = ? WHERE id = ?';
		$fields = [request('id'), request('name'), request('start_stop_id'), request('end_stop_id'), $id];

		DB::update($sql, $fields);

		return redirect('/routes/');
	}

	public function destroy($id)
	{
		Auth::user()->authenticateAdmin();

		$sql = 'DELETE FROM routes WHERE id = ' . $id;
		DB::delete($sql);

		$sql = 'DELETE FROM runs WHERE route_id = ' . $id;
		DB::delete($sql);
		
		return redirect('/routes');
	}

	/** these work better but don't use sql directly so yeah

	public function index()
	{
		$routes = Route::all();

		return view('routes.index', compact('routes'));
	}

	public function create()
	{
		return view('routes.create');
	}

	public function store()
	{
		$attributes = request()->validate([
			'id' => ['required'],
			'name' => ['required', 'min:2', 'max:255'],
			'start_stop_id' => ['required'],
			'end_stop_id' => ['required'],
		]);

		Route::create($attributes);

		return redirect('/routes');
	}

	public function show(Route $route)
	{
		return view('routes.show', compact('route'));
	}

	public function edit(Route $route)
	{
		return view('routes.edit', compact('route'));
	}

	public function update(Route $route)
	{
		$route->update(request(['id', 'route_name', 'service_start_time', 'start_stop_id', 'end_stop_id']));

		return redirect('/routes/');
	}

	public function destroy(Route $route)
	{
		$route->delete();
		
		return redirect('/routes');
	}
	
	**/
}
