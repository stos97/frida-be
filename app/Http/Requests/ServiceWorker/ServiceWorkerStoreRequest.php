<?php

namespace App\Http\Requests\ServiceWorker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ServiceWorkerStoreRequest extends FormRequest
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
            'service_id' => ['required', 'exists:services,id'],
            'price' => ['required', 'integer'],
            'minutesNeeded' => ['required', 'integer'],
            'additional_services' => ['array'],
            'additional_services.*.additional_service_id' => [
                'integer',
                'exists:additional_services,id',
                function ($attribute, $value, $fail)  {

                    if (!DB::table('additional_service_service')
                        ->where('service_id', $this->request->get('service_id'))
                        ->where('additional_service_id', $value)
                        ->exists()) {
                        $fail('The selected additional service is not associated with the selected service.');
                    }
                }
            ],
            'additional_services.*.price' => ['integer'],
            'additional_services.*.minutesNeeded' => ['integer'],
        ];
    }
}
