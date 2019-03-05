<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //
            'username'=>'required | min:3 | max:16 | unique:users',
            'mobile'=>[
                'required',
                'regex:/18[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/',
                'unique:users',
                'max:11',
            ],
            'face'=>'image | max:5120',
            'password'=>'required | min:6 | max:18 | confirmed',
            'password_confirmation'=>'required',
            'mobile_code'=>'required',
            'agree'=>'accepted',
        ];
    }
}
