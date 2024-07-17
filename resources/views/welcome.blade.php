@php use App\Models\Admin\UserType; @endphp
@extends('base')

@section('page_title', 'Home')

@section('content')
    @php
        $routeName = request()->route()->getName();
        $admin = UserType::where('name', 'admin')->value('id');
        $guest = UserType::where('name', 'user')->value('id');
    @endphp
    <h1>Home</h1>
    @auth
        <div class="container py-5">
            @foreach($accounttypes as $accounttype)
                <div class="bg-white rounded-lg p-5 shadow m-5">
                    <h2 class="h6 font-weight-bold text-start mb-4">{{ $accounttype->name }}</h2>
                    <div class="row justify-content-center">
                        @foreach($accounts->where('account_type_id', $accounttype->id) as $account)
                            @php
                                $amount = $account->amount()->value('value');
                                $percent = $amount / $settings->where('name', 'max_gauge')->first()->value * 100;
                                $borders_success = "border-success";
                                $borders_warning = "border-warning";
                                $borders_danger = "border-danger";
                                if ($amount<0)
                                    {
                                        $borders = $borders_danger;
                                        $percent = 100;
                                    }
                                elseif ($amount>500)
                                    {
                                        $borders = $borders_success;
                                    }
                                else
                                    {
                                        $borders = $borders_warning;
                                    }
                            @endphp
                            <div class="col-xl-3 col-lg-6 mb-4">
                                <div class="bg-white rounded-lg p-5 shadow">
                                    <h2 class="h6 font-weight-bold text-center mb-4">Account n°{{ $account->number }}</h2>
                                    <div class="progress mx-auto" data-value='{{ $percent }}'>
                                        <span class="progress-left">
                                        <span @class(["progress-bar", $borders])></span>
                                        </span>
                                        <span class="progress-right">
                                        <span class="progress-bar {{ $borders }}"></span>
                                        </span>
                                        <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center
                                        justify-content-center">
                                            <div class="h2 font-weight-bold">{{ number_format($amount, 2, decimal_separator: ',', thousands_separator:' ') }}€
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <form action="{{ route('app.transactions.search') }}" method="post">
                                            @csrf
                                            @method("POST")
                                            <input checked type="radio" class="visually-hidden" name="account_id"
                                                   id="account_id" value="{{ $account->id }}">
                                            <input type="radio" class="visually-hidden" name="transaction_type_id"
                                                   id="transaction_type_id">
                                            <button class="btn btn-success mt-5" type="submit"><i class="bi bi-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endauth
@endsection
