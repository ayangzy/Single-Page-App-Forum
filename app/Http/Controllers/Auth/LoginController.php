<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends BaseController
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->errorResponse('Provided credentials is not valid', Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('email', $request->get('email'))->first();
        $token = $user->createToken('singlepageapplication');
        $user->token = $token->plainTextToken;
        return $this->successResponse('Successfully logged in', new LoginResource($user));


    }
}
