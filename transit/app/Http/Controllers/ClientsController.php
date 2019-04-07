<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ClientsController extends Controller
{
	public function authenticateClient($client) {
		if ($client->user_id != Auth::user()->id) abort(404);
	}

	public function show($id)
	{
		$sql = 'SELECT * FROM clients WHERE user_id = ' . $id;
		$client = collect(DB::select($sql))->first();

		$this->authenticateClient($client);

		return view('clients.show', compact('client'));
	}

	public function edit($id)
	{
		$sql = 'SELECT * FROM clients WHERE user_id = ' . $id;
		$client = collect(DB::select($sql))->first();

		$this->authenticateClient($client);

		return view('clients.edit', compact('client'));
	}

	public function update($id)
	{
		$attributes = request()->validate([
			'name' => ['required'],
			'email' => ['required'],
		]);

		$sql = 'UPDATE users SET name = ?, email = ? WHERE id = ?';
		$fields = [request('name'), request('email'), $id];

		DB::update($sql, $fields);

		return redirect('/clients/' . $id);
	}

	public function deposit($id)
	{
		$attributes = request()->validate([
			'card_number' => ['required'],
			'deposit_amount' => ['required'],
		]);

		$sql = 'SELECT * FROM clients WHERE user_id = ' . $id;
		$client = collect(DB::select($sql))->first();

		$new_account_balance = request('deposit_amount') + $client->account_balance;

		$sql = 'UPDATE clients SET account_balance = ? WHERE user_id = ?';
		$fields = [$new_account_balance, $id];

		DB::update($sql, $fields);

		return redirect('/clients/' . $id);
	}
}
