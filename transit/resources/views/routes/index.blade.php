@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Routes <br>

                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <a href="routes/create">
                            <button>Create New Route</button>
                        </a>
                    @endif
                </div>

                @foreach ($routes as $route)
                <div class="card-body">
					<article>
						<h2>
							<a href="/routes/{{ $route->id }}/"> Route {{ $route->id }}: {{ $route->name }} </a>
						</h2>
						Start stop: {{ $route->start_stop_id }} <br>
						End stop: {{ $route->end_stop_id }} <br>
					</article>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection