@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Employees <br>
                </div>

                @foreach ($employees as $emp)
                <div class="card-body">
					<article>
						<h2>
							Employee: {{ $emp->name }}
						</h2>
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