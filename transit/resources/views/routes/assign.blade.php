@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- display runs for route -->

            <div class="card">
                <div class="card-header">
                    <h3>Route {{ $route->id }}: Assign New Route Legs </h3>

            <!-- add a new route_leg for the route -->
            <div class="card">
                <div class="card-header">
                    Create New Route Leg
                </div>

                <div class="card-body">
                    <form method="POST" action="/routes/{{ $route->id }}/assignStore">
                        @csrf

                        <div class="field">
                            <label class ="label" for="start_stop_id">Start Stop</label> <br>
                            <select class="control" name="start_stop_id">
                                @foreach ($stops as $stop)
                                    <option class = "input" value="{{ $stop->id }}"> {{ $stop->id }}: {{ $stop->address }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label class ="label" for="end_stop_id">End Stop</label> <br>
                            <select class="control" name="end_stop_id">
                                @foreach ($stops as $stop)
                                    <option class = "input" value="{{ $stop->id }}"> {{ $stop->id }}: {{ $stop->address }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label class="label" for="duration">Duration</label>

                            <div class="control">
                                <input type="number" name="duration" placeholder="5">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit">Assign Route Leg</button>
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

        </div>
    </div>
</div>

@endsection