@extends('layouts.app') 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3>Analytics </h3><br>
        </div>

        @foreach ($routes as $route)
        <div class="card-body">
          <article>
            <h3>
              <a href="/analyst/{{ $route->id }}/"> Route {{ $route->id }}: {{ $route->name }} </a>
            </h3>
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