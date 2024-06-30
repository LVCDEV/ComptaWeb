@extends('base')

@section('page_title', __('transactions.page_title'))

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Transactions</h1>
        <a href="{{ route('app.transactions.create') }}" class="btn btn-primary btn-lg"><i class="bi bi-file-earmark-plus"></i>
            Add</a>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-hover table-primary">
            <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Type</th>
                <th scope="col">Account</th>
                <th scope="col">Beneficiary</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
                <th scope="col">User</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($transactions as $transaction)
                <tr>
                    <th scope="row">{{ $transaction->id }}</th>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_type->name }}</td>
                    <td>{{ $transaction->account->number }}</td>
                    <td>{{ $transaction->beneficiary }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ number_format($transaction->amount, 2, decimal_separator: ',', thousands_separator: ' ') }} €</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
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
