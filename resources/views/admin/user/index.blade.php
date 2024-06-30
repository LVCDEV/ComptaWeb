@extends('admin.admin_base')

@section('admin_page_title', 'Users')

@section('admin_content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-lg"><i class="bi bi-person-fill-add"></i> Add</a>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped table-hover table-primary">
            <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->userType->name }}</td>
                    <td>
                        <div class="d-flex gap-2 w-100 justify-content-end">
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="post">
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
        {{ $users->links() }}
    </div>
@endsection
