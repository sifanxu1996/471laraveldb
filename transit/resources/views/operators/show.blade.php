@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>My Assigned Runs</h3> <br>
                </div>
                
                <div class="card-body">
					<article>

                        @foreach ($runs as $run)
                        <div class="card">
                            <div class="card-header">
                                <h5>Route: {{ $run->route_id }}, {{ $run->name }} </h5>
                            </div>
                            <div class='card-body'>
                                Start stop: {{ $run->start_stop_id }} <br>
                                End stop: {{ $run->end_stop_id }} <br>
                                Time: {{ date('H:i', strtotime($run->start_time)) }} <br>
                            </div>
                        </div>
                        @endforeach

					</article>
                </div>
                

            </div>
        </div>
    </div>
</div>

@endsection