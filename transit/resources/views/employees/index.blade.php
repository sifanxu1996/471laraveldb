@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Employees</h3> <br>
                </div>

                @foreach ($employees as $emp)
                <div class="card-body">
					<article>
						<h3>
							Employee: {{ $emp->name }}
                        </h3>
						Email: {{ $emp->email }} <br>
                        Role: {{ $emp->emp_type }} <br>
                        SSN: {{ $emp->ssn }} <br>
					</article>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection