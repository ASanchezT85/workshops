<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCourse extends FormRequest
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
            'lang_id'       => 'required|integer',
            'category_id'   => 'required|integer',
            'name'          => 'required|string|min:10',
            'description'   => 'required|string|min:10',
            'headed_to'     => 'required|string|min:10',
            'deception'     => 'required|string|min:10',
            'state'         => 'required|in:ACTIVE,INACTIVE',
            'file'          => 'required|mimes:jpg,jpeg,png,svg',
            'barnners'      => 'required|array',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
