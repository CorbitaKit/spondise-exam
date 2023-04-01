<?php

namespace App\Http\Controllers;

use App\Http\Repositories\LoginRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request, LoginRepository $repo)
    {
        return $repo->doLogin($request);
    }
}
