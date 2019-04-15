<?php

namespace App\Http\Controllers;

use App\User;
use App\Route;
use App\Run;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StopsController extends Controller
{
    public function index()
    {
        $sql = 'SELECT * FROM stops ORDER BY id';
        $stops = DB::select($sql);

        return view('stops.index', compact('stops'));
    }

    public function show($id)
    {
        $sql = 'SELECT * FROM stops WHERE id = ' . $id;
        $stops = collect(DB::select($sql))->first();

        define("sql1", 'SELECT * FROM route_legs rs WHERE rs.end_stop_id = ' . $id . ' ORDER BY rs.route_id');
        $route_legs = DB::select(sql1);

        $sql = 'SELECT * FROM route_legs';
        $route_legs_all = DB::select($sql);

        define("sql2" , 'SELECT * FROM routes r WHERE r.start_stop_id = ' . $id . ' AND r.id NOT IN( SELECT rl.route_id FROM route_legs rl WHERE rl.end_stop_id = ' . $id . ' ) ORDER BY r.id');
        $runs_start_at = DB::select(sql2);

        $sql = 'SELECT rab.id, h.name FROM (SELECT rr.route_id AS id FROM (' . sql1 . ') rr UNION SELECT ra.id FROM (' . sql2 . ') ra ) rab, routes h WHERE rab.id = h.id ORDER BY rab.id';
        $all_at_stop = DB::select($sql);

        $sql = 'SELECT * FROM runs';
        $runs = DB::select($sql);

        $sql = 'SELECT * FROM routes';
        $routes = DB::select($sql);

        return view('stops.show', compact( 'stops', 'runs_start_at', 'runs', 'all_at_stop', 'route_legs', 'routes', 'route_legs_all'));
    }

    public function store() {
        request()->validate([
            'address' => ['required'],
        ]);

        $sql = 'INSERT INTO stops (address) VALUES (?)';
        $fields = [request('address')];
        DB::insert($sql, $fields);

        return redirect('/stops/');
    }

    public function destroy($id) {
        Auth::user()->authenticateAdmin();

        $sql = 'DELETE FROM stops WHERE id = ' . $id;
        DB::delete($sql);

        return redirect('/stops/');
    }
}