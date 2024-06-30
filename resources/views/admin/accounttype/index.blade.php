@extends('admin.admin_base')

@section('admin_page_title', 'Account types')

@section('admin_content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Account types</h1>
        <a href="{{ route('admin.accounttypes.create') }}" class="btn btn-primary btn-lg"><i class="bi bi-file-earmark-plus"></i> Add</a>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-hover table-primary">
            <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($accounttypes as $accounttype)
                <tr>
                    <th scope="row">{{ $accounttype->id }}</th>
                    <td>{{ $accounttype->name }}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.accounttypes.edit', ['accounttype' => $accounttype->id]) }}" class="btn btn-warning btn-sm"><i
                                    class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('admin.accounttypes.destroy', $accounttype) }}" method="post">
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
        {{ $accounttypes->links() }}
    </div>
@endsection
