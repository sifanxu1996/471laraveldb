<?php

namespace App\Http\Controllers;

use App\User;
use App\Route;
use App\Run;
use DB;

use Illuminate\Http\Request;

class StopsController extends Controller
{
    public function index()
    {
        $sql = 'SELECT * FROM stops';
        $stops = DB::select($sql);

        return view('stops.index', compact('stops'));
    }

    public function show($id)
    {
        $sql = 'SELECT * FROM stops WHERE id = ' . $id;
        $stops = collect(DB::select($sql))->first();

        $sql = 'SELECT * FROM route_legs WHERE end_stop_id = ' . $id . ' ORDER BY route_id';
        $route_legs = DB::select($sql);

        $sql = 'SELECT rl.route_id, rn.start_time FROM route_legs rl, runs rn WHERE rl.end_stop_id = ' . $id . ' AND rl.route_id = rn.route_id';
        $runs = DB::select($sql);

        return view('stops.show', compact('stops', 'route_legs', 'runs'));
    }
}


/* CREATE TABLE Prev_Stop (
    routeID bigint(20) UNSIGNED NOT NULL,
    startID int(11) NOT NULL,
    stopID int(11) NOT NULL,
    travelTime int(11) NOT NULL
    );
    
INSERT INTO Prev_Stop (routeID, startID, stopID, travelTime) VALUES
((SELECT route_id, start_stop_id, end_stop_id, duration FROM route_legs rl WHERE rl.end_stop_id = 1040)
        UNION
        (SELECT rl.route_id, rl.start_stop_id, rl.end_stop_id, rl.duration
        FROM route_legs rl JOIN Prev_Stop p ON (rl.end_stop_id=p.startID AND rl.route_id=p.routeID)
        JOIN routes rt ON (rt.id=rl.route_id AND rt.start_stop_id=rl.start_stop_id) )); */