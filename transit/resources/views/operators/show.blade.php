@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    My Assigned Runs <br>
                </div>
                
                <div class="card-body">
					<article>

                        @foreach ($runs as $run)
                        <div class="card">
                            <div class="card-header">
                                Route: {{ $run->route_id }}, {{ $run->name }} <br>
                            </div>
                            <div class='card-body'>
                                Start stop: {{ $run->start_stop_id }} <br>
                                End stop: {{ $run->end_stop_id }} <br>
                                Time: {{ $run->start_time }} <br>
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