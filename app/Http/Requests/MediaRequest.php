<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class MediaRequest extends FormRequest
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
            'description' => 'required|max:100',
            'file' => 'required|mimes:jpeg,jpg,mpa,mp3,png|max:5120'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max'=> 'O campo :attribute deve conter no máximo :max caracteres.',
            'mimes' => 'Tipo de arquivo não suportado.'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'Descrição',
            'file' => 'Arquivo'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),  Response::HTTP_NOT_ACCEPTABLE));
    }
}
