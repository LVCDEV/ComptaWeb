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
            <div class="row">
                @foreach($accounts->where('account_type_id', 1) as $account)
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
                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">{{ number_format($amount, 2, decimal_separator: ',', thousands_separator:
                         ' ') }}€</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endauth
@endsection
