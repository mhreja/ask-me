<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'register_as' => ['required', 'integer', 'min:1', 'max:2'],
            'preparing_exams_for' => ['nullable', 'string', 'max:255'],
            'class' => ['nullable', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'city' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'regex:/^[6-9]\d{9}$/', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        switch($input['register_as']) {
            case 1:
                $user_type = 'Student';
                break;
            
            case 2:
                $user_type = 'Teacher';
                break;
        }

        return User::create([
            'user_type' => $user_type,
            'preparing_exams_for' => $input['preparing_exams_for'],
            'class' => $input['class'],
            'name' => $input['name'],
            'dob' => $input['dob'],
            'city' => $input['city'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
        ]);
    }
}