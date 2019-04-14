@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Add Vehicle</h3> <br>
                </div>

                <div class="card-body">
                    <form method="POST" action="/vehicles/" class="box">
                        @csrf

                        <div class="field">
                            <label class="label" for="license">License</label>
                            <div class="control">
                                <input type="text" class="input" name="license">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="capacity">Capacity</label>
                            <div class="control">
                                <input type="number" class="input" name="capacity">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit">Add Vehicle</button>
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