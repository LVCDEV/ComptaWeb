@extends('base')

@section('page_title', $transaction->exists ? __('transactions.page_title_edit') : __('transactions.page_title_create'))

@section('content')
    <h1>{{ $transaction->exists ? __('transactions.page_title_edit') : __('transactions.page_title_create') }}</h1>
    <form action="{{ route($transaction->exists ? 'app.transactions.update' : 'app.transactions.store_transfert',
    ['transaction' => $transaction]) }}" method="POST" class="vstack m-5">
        @csrf
        @method($transaction->id ? "PATCH" : "POST")
        <div class="row mt-5">
            <div class="col-2">
                @include('shared.input', ['icon' => 'bi bi-calendar3', 'type' => 'date', 'name' => 'date',
                'value' => $transaction->date])
            </div>
        </div>
        <div class="row align-content-between align-items-center">
            <div class="col-4">
                @include('shared.select', ['label' => __('transactions.issuing_account_label'), 'name' => 'account_id', 'select_value' =>
                $transaction->account_id, 'option_values' => $accounts, 'option_value_text' => 'number'])
            </div>
            <div class="col-4">
                @include('shared.select', ['label' => __('transactions.transactions.receiving_account_label'), 'name' => 'beneficiary', 'select_value' => $transaction->account_id, 'option_values' => $accounts, 'option_value_text' => 'number'])
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('shared.input', ['label' => __('transactions.description_label'), 'type' => 'text', 'name' =>
                'description', 'value' => $transaction->description])
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                @include('shared.input_number', ['label' => __('transactions.amount_label'), 'type' => 'number', 'name' =>
                'amount', 'value' =>
                $transaction->amount, 'step' => 0.01])
            </div>
        </div>
        <div class="pt-5">
            <button class="btn btn-success">
                @if ($transaction->id)
                    <i class="bi bi-pencil-square"></i> {{ __('transactions.edit_button_label') }}
                @else
                    <i class="bi bi-person-fill-add"></i> {{ __('transactions.create_button_label') }}
                @endif
            </button>
            <a href="{{ route('app.transactions.index') }}" class="btn btn-danger"><i class="bi bi-arrow-return-left"></i>
                {{ __('transactions.return_button_label') }}</a>
        </div>
    </form>
@endsection
