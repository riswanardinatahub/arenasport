<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:10',
            'number_phone' => 'required|min:10|max:12',
            // 'email' => 'required|email|unique:users',
            'email' => 'required|email|unique:users,email,' .  $this->route('user'),                    
            'roles' => 'nullable|string|in:ADMIN,USER,ADMINSTORE'
        ];

      
    }
}
