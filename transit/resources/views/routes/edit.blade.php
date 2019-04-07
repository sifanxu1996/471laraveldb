@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Route {{ $route->id }}</div>

                <div class="card-body">
                    <form method="POST" action="/routes/{{ $route->id }}" style="margin-bottom: 1em">
                        @method('PATCH')
                        @csrf

                        <div class="field">
                            <label class="label" for="id">Route ID</label>

                            <div class="control">
                                <input type="number" name="id" placeholder="route id" value="{{ $route->id }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="name">Route Name</label>
                            <div class="control">
                                <input type="text" class="input" name="name" value="{{ $route->name }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="start_stop_id">Start Stop ID</label>
                            
                            <div class="control">
                                <input type="number" min="1000" max="9999" name="start_stop_id" value="{{ $route->start_stop_id }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="end_stop_id">End Stop ID</label>
                            
                            <div class="control">
                                <input type="number" min="1000" max="9999" name="end_stop_id" value="{{ $route->end_stop_id }}">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">Update Route</button>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="/routes/{{ $route->id }}">
                        @method('DELETE')
                        @csrf

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">Delete Route</button>
                            </div>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="notification is-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@endsection