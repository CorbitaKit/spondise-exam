<?php

namespace App\Http\Repositories;

use App\Models\User;
use Hash;
class RegistrationRepository
{
    public function doRegister(object $data): object
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        return $user;
    }
}