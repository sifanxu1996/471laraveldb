@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Account Details</h3><br>
                </div>

                <div class="card-body">
                    <form method="POST" action="/clients/{{ $client->user_id }}" style="margin-bottom: 1em">
                        @method('PATCH')
                        @csrf

                        <div class="field">
                            <label class="label" for="name">Name</label>
                            <div class="control">
                                <input type="text" class="input" name="name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="email">Email</label>

                            <div class="control">
                                <input type="text" name="email" placeholder="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">Update Account Info</button>
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