@extends('admin.admin_base')

@section('admin_page_title', $bank->exists ? 'Edit bank' : 'Create bank')

@section('admin_content')
    <form
        action="{{ route($bank->exists ? 'admin.banks.update' : 'admin.banks.store', ['bank' => $bank]) }}"
        method="POST" class="vstack m-5">
        @csrf
        @method($bank->id ? "PATCH" : "POST")
        @include('shared.input', ['label' => 'Name', 'type' => 'text', 'name' => 'name', 'value' => $bank->name])
        @include('shared.input', ['icon' => 'bi bi-house', 'type' => 'text', 'name' => 'address', 'value' => $bank->address])
        <div class="row">
            <div class="col-2">
                @include('shared.input', ['label' => 'Zip code', 'type' => 'number', 'name' => 'zipcode',
                'value' => $bank->zipcode])
            </div>
            <div class="col">
                @include('shared.input', ['label' => 'City', 'type' => 'text', 'name' => 'city', 'value' => $bank->city])
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                @include('shared.input', ['icon' => 'bi bi-telephone', 'type' => 'tel', 'name' => 'phone', 'value' =>
                $bank->phone])
            </div>
            <div class="col">
                @include('shared.input', ['icon' => 'bi bi-envelope-at', 'type' => 'email', 'name' => 'email', 'value' => $bank->email])
            </div>
        </div>
        @include('shared.input', ['icon' => 'bi bi-globe', 'type' => 'text', 'name' => 'website', 'value' =>
        $bank->website])
        <hr class="table-group-divider m-5">
        @include('shared.input', ['label' => 'Advise', 'type' => 'text', 'name' => 'advise', 'value' => $bank->advise])
        <div class="row">
            <div class="col-3">
                @include('shared.input', ['icon' => 'bi bi-telephone', 'type' => 'tel', 'name' => 'advise_phone', 'value' =>
                $bank->advise_phone])
            </div>
            <div class="col">
                @include('shared.input', ['icon' => 'bi bi-envelope-at', 'type' => 'email', 'name' => 'advise_email', 'value' =>
                $bank->advise_email])
            </div>
        </div>
        <div class="pt-5">
            <button class="btn btn-success">
                @if ($bank->id)
                    <i class="bi bi-pencil-square"></i> Modifier
                @else
                    <i class="bi bi-person-fill-add"></i> Créer
                @endif
            </button>
            <a href="{{ route('admin.banks.index') }}" class="btn btn-danger"><i class="bi bi-arrow-return-left"></i> Return</a>
        </div>
    </form>
@endsection
