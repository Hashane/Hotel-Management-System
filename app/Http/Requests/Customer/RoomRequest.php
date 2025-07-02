<?php

namespace App\Http\Requests\Customer;

use App\Enums\RoomCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'room_category' => ['nullable', 'string', Rule::in(array_merge(['any'], array_column(RoomCategory::cases(), 'value')))],
            'check_in' => ['sometimes', 'required_with:check_out', 'date_format:Y-m-d', 'before:check_out'],
            'check_out' => ['sometimes', 'required_with:check_in', 'date_format:Y-m-d', 'after:check_in'],
        ];
    }
}
