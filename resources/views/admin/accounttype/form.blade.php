@extends('admin.admin_base')

@section('admin_page_title', $accounttype->exists ? 'Edit account type' : 'Create account type')

@section('admin_content')
    <form
        action="{{ route($accounttype->exists ? 'admin.accounttypes.update' : 'admin.accounttypes.store', ['accounttype' => $accounttype]) }}"
        method="POST" class="vstack m-5">
        @csrf
        @method($accounttype->id ? "PATCH" : "POST")
        @include('shared.input', ['label' => 'Name', 'type' => 'text', 'name' => 'name', 'value' => $accounttype->name])
        <div class="pt-5">
            <button class="btn btn-success">
                @if ($accounttype->id)
                    <i class="bi bi-pencil-square"></i> Modifier
                @else
                    <i class="bi bi-person-fill-add"></i> Créer
                @endif
            </button>
            <a href="{{ route('admin.accounttypes.index') }}" class="btn btn-danger"><i class="bi bi-arrow-return-left"></i> Return</a>
        </div>
    </form>
@endsection
