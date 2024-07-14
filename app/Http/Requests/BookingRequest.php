<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'date',
            'end_date' => 'date',
            'end_date' => 'date',
            'address' => 'string',
            'city' => 'string|max:255',
            'zip' => 'string|max:255',
            'status' => 'string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
            'payment_url' => 'string|max:255',
            'total_price' => 'required|numeric',
            'item_id' => 'required|integer|exists:items,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
