<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends BaseController
{
    public function userProfile()
    {
        $user = auth()->user();
        if(!$user){
          return $this->errorResponse('Unable to retrieve profile', Response::HTTP_BAD_REQUEST);
        }
        return $this->successResponse('user successfully retrieved', new UserProfileResource($user) );
    }

    public function logOut(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse('You have been successfully logged out!');
    }
}
