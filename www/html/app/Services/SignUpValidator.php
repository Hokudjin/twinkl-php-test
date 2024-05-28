<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class SignUpValidator
{
    public function validate(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:student,teacher,parent,private_tutor',
        ])->validate();
    }
}
