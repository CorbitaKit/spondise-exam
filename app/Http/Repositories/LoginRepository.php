<?php

namespace App\Http\Repositories;
use Hash;
use App\Models\User;
use Illuminate\Http\Response;

class LoginRepository
{
    public function doLogin(object $data): object
    {
        $user = User::whereEmail($data->email)->first();
        if (! $user || ! Hash::check($data->password, $user->password)) {
            return response("Credentials don't match", Response::HTTP_UNAUTHORIZED);
        }

        $user->update(['last_login' => date('Y-m-d')]);
        $token = $user->createToken('web:api');
        return response([
            'token' => $token->plainTextToken,
            'user' => $user,
        ]);
    }
}