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
                        <br>
                    @endif

                    @foreach ($route_legs as $route_leg)
                        <div class="card">
                            <div class='card-header'>Route Leg {{ $route_leg->id }}</div>
                            <div class="card-body">
                                Start Stop: {{ $route_leg->start_stop_id }} <br>
                                End Stop: {{ $route_leg->end_stop_id }} <br>
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
                                Admin: {{ $run->admin_id }} <br>
                                Operator: {{ $run->operator_id}} <br>
                                Vehicle: {{ $run->vehicle_id }} <br>
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
                                <label class="label" for="operator_id">Operator</label>

                                <div class="control">
                                    <input type="number" class="input" name="operator_id">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="vehicle_id">Vehicle</label>

                                <div class="control">
                                    <input type="number" class="input" name="vehicle_id">
                                </div>
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