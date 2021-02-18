<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
                        'answer' => 'required|string',
                        'title' => 'required|string',
                        "question_id"  => "required|numeric",
                    ];
                }
                break;
            case 'PATCH':
                {
                    $rules = [
                        'answer' => 'required|string',
                        'title' => 'required|string',
                        "question_id"  => "required|numeric",
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
            'required' => 'يوجد حقل لم يتم ادخالة',
            'max' => 'المحتوى اكثر من المسموح',
            'min' => 'المحتوى اقل من المسموح',
            'string' => 'المحتوى يجب ان يكون نص',
            'mimes' => 'امتداد خاطئ',
            'numeric' => 'يجب ان يكون رقم',
        ];
    }
}
