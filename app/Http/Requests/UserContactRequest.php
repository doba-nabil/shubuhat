<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserContactRequest extends FormRequest
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
            'name' => 'required|max:100|min:1|string',
            'email' => 'required|email',
            'title' => 'required|max:100|string',
            'kind' => 'required',
            'message' => 'required|min:10|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم مطلوب',
            'email.required' => 'حقل البريد مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
            'kind.required' => 'حقل النوع مطلوب',
            'message.required' => 'حقل الرسالة مطلوب',
            'name.max' => 'المحتوى في الاسم اكثر من المسموح',
            'title.max' => 'المحتوى في العنوان اكثر من المسموح',
            'email.email' => 'بريد خاطئ',
            'name.min' => 'المحتوى في الاسم اقل من المسموح',
            'message.min' => 'المحتوى في الرسالة اقل من المسموح',
            'message.string' => 'محتوى الرسالة يجب ان يكون نص',
            'title.string' => 'محتوى العنوان يجب ان يكون نص',
            'name.string' => 'محتوى الاسم يجب ان يكون نص',
        ];
    }
}
