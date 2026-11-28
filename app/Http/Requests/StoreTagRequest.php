<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage-tags');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
            'slug' => ['required', 'string', 'max:255', 'unique:tags,slug'],
        ];
    }
}