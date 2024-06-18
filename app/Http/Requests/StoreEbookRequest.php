<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEbookRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus di isi',
            'name.string' => 'Nama harus huruf',
            'name.max' => 'Karakter terlalu panjang',
            'file.required' => 'File harus di isi'
        ];
    }
}
