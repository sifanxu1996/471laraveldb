@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Employees</h3> <br>
                    <a href="/employees/create">
                        <button>Create New Employee</button>
                    </a>
                </div>

                <!-- display all employees -->
                @foreach ($employees as $emp)
                <div class="card-body">
					<article>
						<h3>
							Employee: {{ $emp->name }}
                        </h3>
						Email: {{ $emp->email }} <br>
                        Role: {{ $emp->role }} <br>
                        SSN: {{ $emp->ssn }} <br>
					</article>

                    <form method="POST" action="/employees/{{ $emp->id }}">
                        @method('DELETE')
                        @csrf

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">Remove Employee</button>
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