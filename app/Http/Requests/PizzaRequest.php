<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PizzaRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($this->id)],
            'price' => ['required', 'numeric'],
            'type' => ['required', Rule::in(['Pizza'])],
            'size' => ['required', Rule::in(['Small', 'Medium', 'Big'])],
            'category' => ['required', Rule::in(['Clássica', 'Vegetariana', 'Gourmet', 'Especial', 'Doce'])],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Data invalid',
            'errors' => $validator->errors(),
        ], 400));
    }
}
