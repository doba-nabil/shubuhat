<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
                        'question' => 'required|min:10|string',
                        'mini_question' => 'required|max:100|string',
                        "category_id.*"  => "required|numeric",
                    ];
                }
                break;
            case 'PATCH':
                {
                    $rules = [
                        'question' => 'required|min:10|string',
                        'mini_question' => 'required|max:100|string',
                        "category_id.*"  => "required|numeric",
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
            'numeric' => 'يجب ان يكون رقم',
        ];
    }
}
