<?php

namespace App\Http\Controllers;

use App\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
{
    public function index()
    {
        $sql = 'SELECT * FROM requests ORDER BY route_id';
        $requests = DB::select($sql);

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        Auth::user()->authenticateAnalyst();

        return view('requests.create');
    }

    public function store()
    {
        Auth::user()->authenticateAnalyst();

        request()->validate([
            'req_message' => ['required'],
            'route_id' => ['required'],
        ]);

        $sql = 'INSERT INTO Requests (req_message, analyst_id, route_id) VALUES (?, ?, ?)';
        $fields = [request('req_message'), Auth::user()->id, request('route_id')];

        DB::insert($sql, $fields);

        return redirect('/requests');
    }
}
