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

		$sql = 'SELECT * FROM users u, clients c WHERE u.id = c.user_id';
		$clients = DB::select($sql);

		return view('employees.index', compact('employees', 'clients'));
	}

	public function create() {
		$sql = 'SELECT * FROM users u, clients c WHERE u.id = c.user_id';
		$clients = DB::select($sql);

		return view('employees.create', compact('clients'));
	}

	public function store() {
		request()->validate([
			'ssn' => ['required', 'min:9', 'max:9'],
		]);

		$id = request('client_id');
		$role = request('role');
		$ssn = request('ssn');

		$sql = 'DELETE FROM clients WHERE user_id = ' . $id;
		DB::delete($sql);

		$sql = 'INSERT INTO employees (user_id, ssn) VALUES (?, ?)';
        $fields = [$id, $ssn];
        DB::insert($sql, $fields);

		$sql = 'UPDATE users SET role = ? WHERE id = ?';
		$fields = [$role, $id];
		DB::update($sql, $fields);

		return redirect('/employees/');
	}

	public function destroy($id) {
		$sql = 'DELETE FROM employees WHERE user_id = ' . $id;
		DB::delete($sql);

		$sql = 'INSERT INTO clients (user_id, account_balance) VALUES (?, ?)';
		$fields = [$id, 0];
		DB::insert($sql, $fields);

		return redirect('/employees/');
	}
}
