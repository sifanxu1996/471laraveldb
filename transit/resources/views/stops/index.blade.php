@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Stops <br>
                </div>

                @foreach ($stops as $stop)
                <div class="card-body">
                  <article>
                    <h2>
                      <a href="/stops/{{ $stop->id }}/"> Stop {{ $stop->id }} </a>
                    </h2>
                    <p style="text-indent: 30px">Address: {{ $stop->address }}</p>
                  </article>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection