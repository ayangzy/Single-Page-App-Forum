<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends BaseController
{
    public function Register(RegisterRequest $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);

        if(!$user->save()){
            return $this->errorResponse('Unable to create account, try again', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Account successfully created', new RegisterResource($user), Response::HTTP_CREATED);
    }
}
