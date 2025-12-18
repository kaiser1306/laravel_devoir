<?php

namespace App\Data;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserData
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(array $data)
    {
        $this->validate($data);

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    /**
     * Validation rules for user data.
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Validate the data.
     */
    private function validate(array $data): void
    {
        $validator = Validator::make($data, self::rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Get the data as array for creation.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }
}