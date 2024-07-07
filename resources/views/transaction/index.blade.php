@extends('base')

@section('page_title', __('transactions.page_title_index'))

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Transactions</h1>
        <a href="{{ route('app.transactions.create') }}" class="btn btn-primary btn-lg"><i class="bi bi-file-earmark-plus"></i>
            Add</a>
    </div>
    <div class="align-content-center">
        <form action="{{ route('app.transactions.search') }}" method="POST">
            @csrf
            @method("POST")
            <div class="row mt-5 mb-5">
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="account_id" id="account_id">
                            <option  selected></option>
                            <@foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->number }}</option>
                            @endforeach
                        </select>
                        <label for="account_id">{{ __('transactions.transaction_account_label') }}</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="transaction_type_id" id="transaction_type_id">
                            <option  selected></option>
                            <@foreach ($transactiontypes as $transactiontype)
                                <option value="{{ $transactiontype->id }}">{{ $transactiontype->name }}</option>
                            @endforeach
                        </select>
                        <label for="transaction_type_id">{{ __('transactions.transaction_type_label') }}</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-1 m-2">
                            <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                        <div class="col-1 m-2">
                            <a href="{{ route('app.transactions.index') }}" class="btn btn-danger"><i class="bi
                        bi-arrow-counterclockwise"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-bordered table-hover table-primary">
            <thead class="table-light">
            <tr>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">Account</th>
                <th scope="col" class="text-center">Beneficiary</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Amount</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($transactions as $transaction)
                <tr>
                    <td class="text-center">{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_type->name }}</td>
                    <td class="text-center">{{ $transaction->account->number }}</td>
                    <td>{{ $transaction->beneficiary }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="text-end">{{ number_format($transaction->amount, 2, decimal_separator: ',', thousands_separator: ' ')
                    }} €</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-center">
                            <a href="{{ route('app.transactions.edit', ['transaction' => $transaction->id]) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('app.transactions.destroy', $transaction) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $transactions->links() }}
    </div>
@endsection
