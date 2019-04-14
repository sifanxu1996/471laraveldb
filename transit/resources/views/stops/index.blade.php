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
                    <form method="POST" action="/stops/{{ $stop->id }}">
                        @method('DELETE')
                        @csrf

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">Delete Stop</button>
                            </div>
                        </div>
                    </form>
                    <p style="text-indent: 30px">Address: {{ $stop->address }}</p>
                  </article>
                </div>
                @endforeach

            </div>

            <!-- add a new run for the route -->
            @if (Auth::user() && Auth::user()->role == 'admin')
                <div class="card">
                    <div class="card-header">
                        Create New Stop
                    </div>

                    <div class="card-body">
                    
                        <form method="POST" action="/stops/" class="box">
                            @csrf
                            <div class="field">
                                <label class="label" for="address">Stop Address</label>

                                <div class="control">
                                    <input type="text" class="input" name="address">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button type="submit">Create Stop</button>
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
            @endif
        </div>
    </div>
</div>

@endsection