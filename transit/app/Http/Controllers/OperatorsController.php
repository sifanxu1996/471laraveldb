<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class OperatorsController extends Controller
{
	public function authenticateOperator($id)
	{
		if ($id != Auth::user()->id) abort(404);
	}

    public function show($id)
    {
    	$this->authenticateOperator($id);

    	$sql = 'SELECT * FROM routes ro, runs ru WHERE ro.id = ru.route_id AND operator_id = ' . $id;
		$runs = DB::select($sql);

		return view('operators.show', compact('runs'));
    }
}