<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'status' => ['required', 'in:want_to_visit,visited'],
            'is_featured' => ['sometimes', 'boolean'],
            'visited_at' => ['nullable', 'date'],
            'website' => ['nullable', 'url', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
        ];
    }
}
