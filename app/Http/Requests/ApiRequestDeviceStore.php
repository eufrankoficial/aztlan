<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequestDeviceStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Informe o do código do dispositivo'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'id',
        ];
    }
}
