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

		return view('routes.create');
	}

	public function store()
	{
		Auth::user()->authenticateAdmin();

		request()->validate([
			'id' => ['required'],
			'name' => ['required', 'min:2', 'max:255'],
			'start_stop_id' => ['required'],
			'end_stop_id' => ['required'],
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

		$sql = 'SELECT * FROM route_legs WHERE route_id = ' . $id;
		$route_legs = DB::select($sql);

		return view('routes.show', compact('route', 'runs', 'route_legs'));
	}

	public function edit($id)
	{
		Auth::user()->authenticateAdmin();

		$sql = 'SELECT * FROM routes WHERE id = ' . $id;
		$route = collect(DB::select($sql))->first();

		return view('routes.edit', compact('route'));
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
