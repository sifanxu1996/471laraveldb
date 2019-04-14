@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Add Employee</h3> <br>
                </div>

                <div class="card-body">
                    <form method="POST" action="/employees/" class="box">
                        @csrf

                        <div class="field">
                            <label class="label" for="client_id">User ID</label> <br>
                            <select class="control" name="client_id">
                                @foreach ($clients as $client)
                                    <option class = "input" value="{{ $client->id }}"> {{ $client->id }}: {{ $client->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label class="label" for="role">Employee Role</label> <br>
                            <select class="control" name="role">
                                    <option class="input" value="operator"> Operator </option>
                                    <option class="input" value="admin"> Admin </option>
                                    <option class="input" value="analyst"> Analyst </option>
                            </select>
                        </div>

                        <div class="field">
                            <label class="label" for="ssn">SSN</label>
                            <div class="control">
                                <input type="number" class="input" name="ssn">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit">Add Employee</button>
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