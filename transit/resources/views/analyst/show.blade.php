@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">

          <!-- display runs for route -->

          <div class="card">
              <div class="card-header">
                  <h3>Route {{ $route->id }} Analytics </h3>
                  
              </div>

              <div class="card-body">
                  @if (!empty($runs))
                      @foreach ($runs as $run)
                <article>
                  <h3>
                                  Run ID: {{ $run->id }}
                  </h3>
                              Time: {{ date('H:i', strtotime($run->start_time)) }} <br>
                              Admin: {{ $run->admin_id }} <br>
                              Operator: {{ $run->operator_id}} <br>
                              Vehicle: {{ $run->vehicle_id }} <br>
                              <ul>
                                  <li>Capacity: {{ $run->capacity }}</li>
                                  <li>Ridership: {{ $run->max_ridership }}</li>
                              </ul>
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