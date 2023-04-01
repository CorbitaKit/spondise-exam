<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RegistrationRepository;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request, RegistrationRepository $repo)
    {
        return response($repo->doRegister($request), 201);
    }
}
