<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HubPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotelId' => 'required|integer',
            'checkIn' => 'required|date|after_or_equal:today|before:checkOut|date_format:Y-m-d',
            'checkOut' => 'required|date|after:checkIn|after_or_equal:today|date_format:Y-m-d',
            'numberOfGuests' => 'required|integer|min:1',
            'numberOfRooms' => 'required|integer|min:1',
            'currency' => 'required|string|size:3',
        ];
    }
}
