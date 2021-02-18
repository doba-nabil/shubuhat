<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $rules = [];
        switch($this->method())
        {
            case 'POST':
                {
                    $rules = [
                        'title' => 'required|max:100|min:1|string',
                        'body' => 'required|min:10|string',
                        'file' => 'required|max:10000|mimes:doc,docx,pdf',
                        'image' => 'mimes:jpg,jpeg,png|max:5000',
                    ];
                }
                break;
            case 'PATCH':
                {
                    $rules = [
                        'title' => 'required|max:100|min:1|string',
                        'body' => 'required|min:10|string',
                        'file' => 'max:10000|mimes:doc,docx,pdf',
                        'image' => 'mimes:jpg,jpeg,png|max:5000',
                    ];
                }
                break;
            default:
                break;
        }
        return $rules;

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
