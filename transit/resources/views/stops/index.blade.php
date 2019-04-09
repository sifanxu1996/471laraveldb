@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Stops <br></h3>
                </div>

                @foreach ($stops as $stop)
                <div class="card-body">
                  <article>
                    <h3>
                      <a href="/stops/{{ $stop->id }}/"> Stop {{ $stop->id }} </a>
                    </h3>
                    <p style="text-indent: 30px">Address: {{ $stop->address }}</p>
                  </article>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection