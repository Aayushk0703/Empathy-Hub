<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null && $this->user()->hasAnyRole(['Admin', 'Staff']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'currency' => ['required', 'string', 'size:3'],
            'stock' => ['nullable', 'integer', 'min:0', 'max:1000000000'],
            'sku' => ['nullable', 'string', 'max:64', 'unique:products,sku'],
            'is_active' => ['nullable', 'boolean'],
            'media_id' => ['nullable', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $slug = $this->input('slug');
        if (empty($slug) && $this->filled('name')) {
            $slug = Str::slug($this->input('name'));
        }

        $this->merge([
            'slug' => $slug,
            'currency' => strtoupper((string) $this->input('currency', 'INR')),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
