<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
                        'name' => 'required|max:100|min:1|string',
                        'email' => 'required|email|unique:users',
                        'phone' => 'required',
                        'password' => 'required|min:6',

                    ];
                }
                break;
            case 'PATCH':
                {
                    $rules = [
                        'name' => 'required|max:100|min:1|string',
                        'email' => 'required|email',
                        'phone' => 'required',
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
