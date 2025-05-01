<?php

namespace App\Http\Requests;

use App\Base\Renter\BalanceOperationType;
use App\Models\Enums\BalanceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateBalanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'amount' => ['required', 'numeric'],
            'operation_type' => ['required', new Enum(BalanceOperationType::class)],
        ];
    }
}
