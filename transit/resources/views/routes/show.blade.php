@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- display runs for route -->

            <div class="card">
                <div class="card-header">
                    Route {{ $route->id }}
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <a href="/routes/{{ $route->id }}/edit">
                            <button>Edit Route</button>
                        </a>
                        <a href="/routes/{{ $route->id }}/assign">
                            <button>Add Route Leg</button>
                        </a>
                        <br>
                    @endif

                    @foreach ($route_legs as $route_leg)
                        <div class="card">
                            <div class='card-header'>Route Leg {{ $route_leg->id }}</div>
                            <div class="card-body">
                                Start Stop: {{ $route_leg->start_stop_id }}, 
                                
                                @foreach ($stops as $stop)
                                    @if ($stop->id == $route_leg->start_stop_id)
                                        {{ $stop->address }}
                                        @break
                                    @endif
                                @endforeach
                                <br>

                                End Stop: {{ $route_leg->end_stop_id }}, 
                                @foreach ($stops as $stop)
                                    @if ($stop->id == $route_leg->end_stop_id)
                                        {{ $stop->address }}
                                        @break
                                    @endif
                                @endforeach
                                <br>

                                Duration: {{ $route_leg->duration }} minutes
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-body">
                    @if (!empty($runs))
                        @foreach ($runs as $run)
        					<article>
        						<h2>
                                    Run ID: {{ $run->id }}
        						</h2>
                                Time: {{ $run->start_time }} <br>
                                Admin ID: {{ $run->admin_id }} <br>
                                Operator ID: {{ $run->operator_id}} <br>
                                Vehicle ID: {{ $run->vehicle_id }} <br>
        					</article>

                            <form method="POST" action="/routes/{{ $route->id }}/runs/{{ $run->id }}">
                                @method('DELETE')
                                @csrf

                                @if (Auth::user() && Auth::user()->role == 'admin')
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="button is-link">Delete Run</button>
                                        </div>
                                    </div>
                                @endif
                                <br>

                            </form>

                        @endforeach
                    @endif
                </div>

            </div>

            <!-- add a new run for the route -->
            @if (Auth::user() && Auth::user()->role == 'admin')
                <div class="card">
                    <div class="card-header">
                        Create New Run
                    </div>

                    <div class="card-body">
                    
                        <form method="POST" action="/routes/{{ $route->id }}/runs" class="box">
                            @csrf
                            <div class="field">
                                <label class="label" for="start_time">Start Time</label>

                                <div class="control">
                                    <input type="time" class="input" name="start_time">
                                </div>
                            </div>

                            <div class="field">
                                <label class = "label" for="operator_id">Operator</label> <br>
                                <select class="control" name="operator_id">
                                    @foreach ($operators as $operator)
                                        <option class = "input" value="{{ $operator->id }}"> {{ $operator->id }}: {{ $operator->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field">
                                <label class = "label" for="vehicle_id">Vehicle</label> <br>
                                <select class="control" name="vehicle_id">
                                    @foreach ($vehicles as $vehicle)
                                        <option class = "input" value="{{ $vehicle->id }}"> {{ $vehicle->license }}: {{ $vehicle->capacity }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button type="submit">Add Run</button>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="notification is-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>

                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection