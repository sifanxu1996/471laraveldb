@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Service Requests <br>

                    @if (Auth::user() && Auth::user()->role == 'analyst')
                        <a href="requests/create">
                            <button>Create New Request</button>
                        </a>
                    @endif
                </div>

                @foreach ($requests as $request)
                <div class="card-body">
                  <article>
                    Request id: {{ $request->id }} <br>
                    Analyst id: {{ $request->analyst_id }} <br>
                    Concerning route <b> #{{ $request->route_id }} </b><br>
                    <p style="margin-left: 40px"><i><b>{{ $request->req_message }}</b></i></p>
                  </article>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection