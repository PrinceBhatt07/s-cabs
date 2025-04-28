<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Api\LoginService;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        return (new LoginService())->login($request);
    }
}
