@php use App\Enums\RoomCategory; @endphp
<select
        name="{{ $name }}"
        id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }}>
    <option value="any">Any</option>
    @foreach(RoomCategory::cases() as $type)
        <option value="{{ $type->value }}"
                {{ $selected == $type->value ? 'selected' : '' }}>
            {{ ucfirst($type->label()) }}
        </option>
    @endforeach
</select>
