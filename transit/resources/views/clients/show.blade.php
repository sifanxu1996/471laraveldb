@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    My Account <br>
                </div>

                <div class="card-body">
                    <h2>
                        <a href="/clients/{{ $client->user_id }}/edit">
                            <button>Edit Account</button>
                        </a>
                    </h2>
					<article>
                        Name: {{ Auth::user()->name }} <br>
                        Email: {{ Auth::user()->email }} <br>
						Transit Account Balance: {{ $client->account_balance }} <br>
					</article>
                </div>

                <div class="card">
                    <div class="card-header">
                        Deposit to Transit Account
                    </div>

                    <div class="card-body">
                    
                        <form method="POST" action="/clients/{{ $client->user_id }}/deposit" class="box">
                            @method('PATCH')
                            @csrf

                            <div class="field">
                                <label class="label" for="card_number">Card Number</label>

                                <div class="control">
                                    <input type="number" class="input" name="card_number">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="deposit_amount">Deposit Amount</label>

                                <div class="control">
                                    <input type="number" class="input" name="deposit_amount">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button type="submit">Make Deposit</button>
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
</div>

@endsection