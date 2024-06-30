@php
    $label ??= null;
    $icon ??= null;
    $name ??= '';
    $div_class ??= null;
    $select_class ??= null;
    $select_values ??= null;
    $option_values ??= null;
    $option_value = rtrim($select_values, 's');
    $option_value_text ??= null;
@endphp

<div @class(["form-floating", "mb-3", "$div_class"])>
    <select @class(["form-select", $select_class]) name="{{ $name }}" id="{{ $name }}">
        <option  value="">Choose...</option>
        <@foreach ($option_values as $option_value)
            <option @selected(old($name, $select_value) == $option_value->id) value="{{ $option_value->id }}">{{ $option_value->$option_value_text }}</option>
        @endforeach
    </select>
    <label for="{{ $name }}">{{ $label }}</label>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
