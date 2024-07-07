@extends('base')

@section('page_title', $account->exists ? 'Edit account' : 'Create account')

@section('content')
    <form
        action="{{ route($account->exists ? 'app.accounts.update' : 'app.accounts.store', ['account' =>
        $account]) }}"
        method="POST" class="vstack m-5">
        @csrf
        @method($account->id ? "PATCH" : "POST")
        <div class="row">
            <div class="col">
                @include('shared.input_number', ['label' => 'Number', 'type' => 'number', 'name' => 'number', 'value' =>
                $account->number])
            </div>
            <div class="col-3">
                @include('shared.input_number', ['label' => 'Balance', 'type' => 'number', 'name' => 'balance', 'value' =>
                $account->balance, 'step' => 0.01])
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('shared.select', ['label' => 'Select type', 'name' => 'account_type_id', 'select_value' => $account->account_type_id, 'option_values' => $accounttypes, 'option_value_text' => 'name'])
            </div>
            <div class="col">
                @include('shared.select', ['label' => 'Select bank', 'name' => 'bank_id', 'select_value' => $account->bank_id,
                'option_values' => $banks, 'option_value_text' => 'name'])
            </div>
        </div>
        <div class="pt-5">
            <button class="btn btn-success">
                @if ($account->id)
                    <i class="bi bi-pencil-square"></i> Modifier
                @else
                    <i class="bi bi-person-fill-add"></i> Créer
                @endif
            </button>
            <a href="{{ route('app.accounts.index') }}" class="btn btn-danger"><i class="bi bi-arrow-return-left"></i>
                Return</a>
        </div>
    </form>
@endsection
