<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class LoginController extends Controller
{
//    public function login(Request $request)
//    {
//        $credentials = $request->only('email', 'password');
//
//        if (Auth::attempt($credentials)) {
//            $user = Auth::user();
//            $token = $user->createToken('BestMovies')->accessToken;
//
//            return response()->json(['token' => $token], 200);
//        }
//
//        return response()->json(['error' => 'Unauthorized'], 401);
//    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->passes()) {
            $user = User::where('email', $request->input('email'))->first();
            if ($user) {
                $user->save();
                $token = JWTAuth::fromUser($user);
                $userData['token'] = $token;
                return response()->json(
                    ['message' => 'User Login successfully',
                    $userData], 201);
            } else {
               return response()->json(['message' => 'Movie not found'], 404);
            }
        }
        else {
            return  response()->json(['message' => 'Movie not found'], 404);
        }
    }
}
