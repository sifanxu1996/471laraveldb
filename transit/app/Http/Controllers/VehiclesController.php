<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class VehiclesController extends Controller
{
    public function index()
	{
		$sql = 'SELECT * FROM vehicles';
		$vehicles = DB::select($sql);

		return view('vehicles.index', compact('vehicles'));
	}

	public function create() {
		return view('vehicles.create');
	}

	public function store() {
		request()->validate([
			'license' => ['required', 'min:3'],
			'capacity' => ['required'],
		]);

		$license = request('license');
		$capacity = request('capacity');

		$sql = 'INSERT INTO vehicles (license, capacity) VALUES (?, ?)';
        $fields = [$license, $capacity];
        DB::insert($sql, $fields);

        return redirect('/vehicles/');
	}

	public function destroy($id) {
		$sql = 'DELETE FROM vehicles WHERE id = ' . $id;
		DB::delete($sql);

		return redirect('/vehicles/');
	}
}
