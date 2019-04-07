@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Route</div>

                <div class="card-body">
                    <form method="POST" action="/routes/">
                        @csrf
                    
                        <div class="field">
                            <label class="label" for="id">Route ID</label>

                            <div class="control">
                                <input type="number" name="id" placeholder="route id" value="{{ old('id') }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="id">Route Name</label>
                            
                            <div class="control">
                                <input type="text" name="name" placeholder="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="start_stop_id">Start Stop ID</label>
                            
                            <div class="control">
                                <input type="number" min="1000" max="9999" name="start_stop_id" value="{{ old('start_stop_id') }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="end_stop_id">End Stop ID</label>
                            
                            <div class="control">
                                <input type="number" min="1000" max="9999" name="end_stop_id" value="{{ old('end_stop_id') }}">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit">Create Route</button>
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
        </div>
    </div>
</div>

@endsection