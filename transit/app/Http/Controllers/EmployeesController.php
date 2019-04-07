<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EmployeesController extends Controller
{
    public function index()
	{
		$sql = 'SELECT * FROM users u, employees e WHERE u.id = e.user_id';
		$employees = DB::select($sql);

		return view('employees.index', compact('employees'));
	}
}
