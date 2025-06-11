@php use App\Enums\RoomType; @endphp
<select
    name="{{ $name }}"
    id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }}>
    @foreach(RoomType::cases() as $type)
        <option value="{{ $type->value }}"
            {{ $selected == $type->value ? 'selected' : '' }}>
            {{ ucfirst($type->label()) }}
        </option>
    @endforeach
</select>
