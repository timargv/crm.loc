<?php

namespace App\Http\Requests\User;

use App\Entity\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:255'],
            'surname'       => ['required', 'string', 'max:255'],
            'patronymic'    => ['required', 'string', 'max:255'],
            'role'          => ['required', 'string', 'max:255', Rule::in(array_keys(User::roleLists()))],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8'],
        ];
    }
}
