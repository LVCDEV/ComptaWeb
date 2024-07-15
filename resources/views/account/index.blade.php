@extends('base')

@section('page_title', 'Accounts')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Accounts</h1>
        <a href="{{ route('app.accounts.create') }}" class="btn btn-primary btn-lg"><i class="bi bi-file-earmark-plus"></i>
            Add</a>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-bordered table-hover table-primary">
            <thead class="table-light">
            <tr>
                <th class="text-center" scope="col">Number</th>
                <th class="text-center" scope="col">Type</th>
                <th class="text-center" scope="col">Balance</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->number }}</td>
                    <td>{{ $account->accounttype->name }}</td>
                    <td class="text-end">{{ number_format($amounts->where('id', $account->id)->first()->value, 2, decimal_separator:
                    ',',
                    thousands_separator: ' ')
                     }} €</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('app.accounts.show', ['account' => $account->id]) }}" class="btn btn-primary btn-sm"><i class="bi bi-postcard"></i> More</a>
                            {{--<a href="{{ route('app.accounts.edit', ['account' => $account->id]) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>--}}
                            <form action="{{ route('app.accounts.destroy', $account) }}" method="post">
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
        {{ $accounts->links() }}
    </div>
@endsection
