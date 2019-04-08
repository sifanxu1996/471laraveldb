@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Service Request</div>

                <div class="card-body">
                    <form method="POST" action="/requests/">
                        @csrf
                    
                        <div class="field">
                            <label class="label" for="route_id">Route ID</label>

                            <div class="control">
                                <input type="number" name="route_id" placeholder="route_id" value="{{ old('route_id') }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="req_message">Request Message</label>
                            
                            <div class="control">
                                <textarea name="req_message" cols="30" rows="6" wrap="hard"></textarea>
                                {{-- <input type="text" name="req_message" style="width: 600px;height: 420px;"> --}}
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit">Create Service Request</button>
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