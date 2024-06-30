@extends('admin.admin_base')

@section('admin_page_title', $user->exists ? 'Edit user' : 'Create user')

@section('admin_content')
    <form
        action="{{ route($user->exists ? 'admin.users.update' : 'admin.users.store', ['user' => $user]) }}"
        method="POST" class="vstack m-5">
        @csrf
        @method($user->id ? "PATCH" : "POST")
        @include('shared.input', ['label' => 'Name', 'type' => 'text', 'name' => 'name', 'value' => $user->name])
        @include('shared.input', ['label' => 'Firstname', 'type' => 'text', 'name' => 'firstname', 'value' => $user->fistname])
        @include('shared.input', ['icon' => 'bi bi-key-fill', 'type' => 'password', 'name' => 'password', 'value' => $user->password])
        @include('shared.input', ['icon' => 'bi bi-envelope-at', 'type' => 'email', 'name' => 'email', 'value' => $user->email])
        @include('shared.select', ['label' => 'Select role', 'name' => 'user_type_id','select_value' => $user->user_type_id, 'option_values' => $usertypes, 'option_value_text' => 'name'])
        <div class="pt-5">
            <button class="btn btn-success">
                @if ($user->id)
                    <i class="bi bi-pencil-square"></i> Modifier
                @else
                    <i class="bi bi-person-fill-add"></i> Créer
                @endif
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-danger"><i class="bi bi-arrow-return-left"></i> Return</a>
        </div>
    </form>
@endsection
