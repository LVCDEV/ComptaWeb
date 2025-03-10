@php
    $label ??= null;
    $type ??= 'text';
    $div_class ??= null;
    $span_class ??= null;
    $input_class ??= null;
    $name ??= '';
    $value ??= '';
    $icon ??= '';
@endphp

<div @class(["input-group", "mb-3", $div_class])>
    <span @class(["input-group-text", $span_class]) id="{{ $name }}"><i @class([$icon])></i>{{ $label }}</span>
    <input class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
           type="{{ $type }}" value="{{ old('name', $value) }}" aria-describedby="{{ $name }}">
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


