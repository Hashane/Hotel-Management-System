<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoomCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterReservationRequest extends FormRequest
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
            'room_type' => ['nullable', Rule::enum(RoomCategory::class)],
            'check_in' => ['nullable', 'date'],
            'check_out' => ['nullable', 'date', 'after_or_equal:check_in'],
            'occupants' => ['nullable', 'integer', 'min:1'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['check_in' => $this->check_in ?? now()->format('Y-m-d')]);
    }
}
