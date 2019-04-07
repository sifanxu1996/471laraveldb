<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalystController extends Controller
{
    public function index()
	{
		$sql = 'SELECT * FROM routes';
		$routes = DB::select($sql);

		return view('analyst.index', compact('routes'));
	}
}
