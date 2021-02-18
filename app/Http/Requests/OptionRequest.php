<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
            'title' => 'required|max:100|min:1|string',
            'phone' => 'required',
            'whatsapp' => 'required',
            'email' => 'required|email',
            'banner_title' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'banner_link' => 'required',
            'terms' => 'required',
            'footer_text' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:5000',
            'folder_ad' => 'mimes:jpg,jpeg,png|max:5000',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'max' => 'المحتوى اكثر من المسموح',
            'min' => 'المحتوى اقل من المسموح',
            'string' => 'المحتوى يجب ان يكون نص',
            'mimes' => 'امتداد خاطئ',
        ];
    }
}
