<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserQuestionRequest extends FormRequest
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
            'question' => 'required|min:10|string',
            'mini_question' => 'required|max:100|string',
        ];
    }
    public function messages()
    {
        return [
            'question.required' => 'حقل السؤال مطلوب',
            'question.mini_required' => 'حقل ملخص السؤال مطلوب',
            'mini_question.max' => 'المحتوى في ملخص السؤال اكثر من المسموح',
            'question.min' => 'المحتوى في حقل السؤال اقل من المسموح',
            'mini_question.string' => 'المحتوى في ملخص السؤال يجب ان يكون نص',
            'question.string' => 'المحتوى في حقل السؤال يجب ان يكون نص',
        ];
    }
}
