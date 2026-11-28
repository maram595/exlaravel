<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage-tags');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'name')->ignore($this->route('tag')),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'slug')->ignore($this->route('tag')),
            ],
        ];
    }
}