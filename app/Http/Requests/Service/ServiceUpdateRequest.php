<?php

namespace App\Http\Requests\Service;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceUpdateRequest extends FormRequest
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
            'name' => ['string'],
            'category_id' => [
                Rule::exists('categories', 'id'),
                function ($attribute, $value, $fail) {
                    $category = Category::withTrashed()->find($value);
                    if ($category && $category->trashed()) {
                        $fail('The selected category has been deleted.');
                    }
                },
            ],
        ];
    }
}
