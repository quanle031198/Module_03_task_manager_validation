<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormTaskRequest extends FormRequest
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
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'image' => 'mimes:img,jpg,png',
            'due_date' => 'required|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        $messages = [
            'title.required' => 'Not empty title',
            'title.min' => 'title phai hon 3 ky tu',
            'content.required' => 'Not empty content',
            'content.min' => 'content phai hon 3 ky tu',
            'image.mimes' => 'image phai co dinh dang .img, .jpg, .png',
            'due_date.required' => 'Not empty date',
            'due_date.date' => 'nhap du ngay thang nam',
        ];
        return $messages;
    }
}
