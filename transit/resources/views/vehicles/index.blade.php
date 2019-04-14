@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Vehicles</h3> <br>
                    <a href="/vehicles/create">
                        <button>Add New Vehicle</button>
                    </a>
                </div>

                <!-- display all vehicles -->
                @foreach ($vehicles as $v)
                <div class="card-body">
					ID: {{ $v->id }} <br>
                    License: {{ $v->license }} <br>
                    Capacity: {{ $v->capacity }} <br>

                    <form method="POST" action="/vehicles/{{ $v->id }}">
                        @method('DELETE')
                        @csrf

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">Delete Vehicle</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection