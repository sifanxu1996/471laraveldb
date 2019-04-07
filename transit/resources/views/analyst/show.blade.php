@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">

          <!-- display runs for route -->

          <div class="card">
              <div class="card-header">
                  Route {{ $route->id }} Analytics
                  
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
                              Ridership: {{ $run->max_ridership }} <br>
                </article>

                          <form method="POST" action="/routes/{{ $route->id }}/runs/{{ $run->id }}">
                              @method('DELETE')
                              @csrf

                              <br>

                          </form>

                      @endforeach
                  @endif
              </div>

          </div>
      </div>
  </div>
</div>


@endsection