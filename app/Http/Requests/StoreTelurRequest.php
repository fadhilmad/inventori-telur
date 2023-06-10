<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTelurRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'satuan_besar_id' => 'required',
            'satuan_kecil_id' => 'required',
            'isi_satuan_kecil' => 'required|int',
        ];
    }

    public function attributes()
    {
        return [
            'satuan_besar_id' => 'satuan besar',
            'satuan_kecil_id' => 'satuan kecil',
            'isi_satuan_kecil' => 'isi satuan kecil',
        ];
    }
}
