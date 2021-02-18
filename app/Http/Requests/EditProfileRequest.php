<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'email' => 'required|max:100|email',
            'social_status' => 'required',
            'religion' => 'required',
            'gender' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'حقل البريد مطلوب',
            'email.max' => 'المحتوى اكثر من المسموح',
            'social_status.required' => 'حقل الحالة الاجتماعية مطلوب',
            'religion.required' => 'حقل الديانة مطلوب',
            'gender.required' => ' حقل الجنس مطلوب',
        ];
    }
}
