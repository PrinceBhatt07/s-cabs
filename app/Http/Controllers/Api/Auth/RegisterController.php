<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Services\RegisterService;
use Exception;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
       return (new RegisterService())->register($request);
    }
}
