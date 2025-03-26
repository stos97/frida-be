<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ServiceWorkerUpdateRequest extends FormRequest
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
            'price' => ['integer'],
            'minutesNeeded' => ['integer'],
            'additions' => ['array'],
            'additions.*.addition_id' => [
                'integer',
                'exists:additions,id',
                function ($attribute, $value, $fail) {

                    if (! DB::table('addition_service')
                        ->where('service_id', $this->request->get('service_id'))
                        ->where('addition_id', $value)
                        ->exists()) {
                        $fail('The selected addition is not associated with the selected service.');
                    }
                },
            ],
            'additions.*.price' => ['integer'],
            'additions.*.minutesNeeded' => ['integer'],
        ];
    }
}
