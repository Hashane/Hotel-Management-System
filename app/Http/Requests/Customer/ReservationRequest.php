<?php

namespace App\Http\Requests\Customer;

use App\Enums\RoomType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends FormRequest
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
        if (request()->method() == 'PUT') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'start' => ['required', 'string'],
                'end' => ['required', 'string'],
                'type' => ['required', Rule::Enum(RoomType::class), 'string'],
                'guests' => ['required', 'string'],
                'room_reservation_id' => ['required', 'string', 'exists:room_reservations,id'],
            ];
        }

        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:customers,email'],
            'message' => ['required', 'string', 'max:255'],

            'card' => ['nullable', 'string', 'digits_between:13,19'],
            'expiry' => [
                Rule::requiredIf(fn () => ! empty($this->card)),
                'nullable',
                'regex:/^(0[1-9]|1[0-2])\/(\d{2})$/',
            ],
            'cvv' => [
                Rule::requiredIf(fn () => ! empty($this->card)),
                'nullable',
                'digits_between:3,4',
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Preserve cart data before validation redirect
        session()->keep(['cart']);

        parent::failedValidation($validator);
    }
}
