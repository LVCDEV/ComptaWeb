@extends('base')

@section('page_title', 'Account - ' . $account->nunber)

@section('content')
    <article>
        <h2 class="text-decoration-underline text-center mb-5 mt-3">{{ $account->number }}</h2>
    </article>
    <a href="{{ route('app.accounts.edit', ['account' => $account->id]) }}" class="btn btn-primary"><i class="bi
    bi-pencil-square"></i> Edit</a>
    <a href="{{ route('app.accounts.destroy', ['account' => $account->id]) }}" class="btn btn-danger"><i class="bi bi-trash"></i>
        Delete</a>
    <a href="{{ route('app.accounts.index') }}" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Return</a>
@endsection
