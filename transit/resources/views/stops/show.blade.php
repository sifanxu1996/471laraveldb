@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- display buses for stop -->

            <div class="card">
                <div class="card-header">
                    Stop {{ $stops->id }}
                </div>

                <div class="card-body">
                    @if (!empty($route_legs))
                        @foreach ($route_legs as $route_leg)
        				        	<article>
        					      	  <h2>
                              Route #: {{ $route_leg->route_id }}
                            </h2>
                            Arrival Times: 
                            <ul>
                            @foreach ($runs as $run)
                                @if ($run->route_id == $route_leg->route_id)
                                    <li>{{ $run->start_time }}</li>
                                @endif
                            @endforeach
                            </ul>
        				        	</article>
                        @endforeach
                    @endif
                </div>

            </div>

            <!-- add a new run for the route -->
            {{-- @if (Auth::user() && Auth::user()->role == 'admin')
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

                            <br>

                            <div class="field">
                                <label class = "label" for="operator_id">Operator</label> <br>
                                <select class="control" name="operator_id">
                                    @foreach ($operators as $operator)
                                        <option class = "input" value="{{ $operator->id }}"> {{ $operator->id }}: {{ $operator->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <div class="field">
                                <label class = "label" for="vehicle_id">Vehicle</label> <br>
                                <select class="control" name="vehicle_id">
                                    @foreach ($vehicles as $vehicle)
                                        <option class = "input" value="{{ $vehicle->id }}"> {{ $vehicle->license }}: {{ $vehicle->capacity }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <div class="field">
                                <label for="max_ridership">Ridership</label> <br>
                                
                                <div class="control">
                                    <input type="text" class="input" name="max_ridership">
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
            @endif --}}

        </div>
    </div>
</div>

@endsection