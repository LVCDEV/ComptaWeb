@extends('admin.admin_base')

@section('admin_page_title', 'Banks')

@section('admin_content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Banks</h1>
        <a href="{{ route('admin.banks.create') }}" class="btn btn-primary btn-lg"><i class="bi bi-file-earmark-plus"></i> Add</a>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-hover table-primary">
            <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($banks as $bank)
                <tr>
                    <th scope="row">{{ $bank->id }}</th>
                    <td>{{ $bank->name }}</td>
                    <td>{{ $bank->email }}</td>
                    <td>{{ $bank->address . " " . $bank->zipcode . ' ' . $bank->city }}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.banks.edit', ['bank' => $bank->id]) }}" class="btn btn-warning btn-sm"><i
                                    class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('admin.banks.destroy', $bank) }}" method="post">
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
        {{ $banks->links() }}
    </div>
@endsection
