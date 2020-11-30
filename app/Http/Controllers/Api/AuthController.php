<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData =  [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
//        $validatedData = [];
//        $name = $request->get('name') ? $request->get('name') : 0;
//        $email = $request->get('email') ? $request->get('email') : 0;
//        $password = $request->get('password') ? $request->get('password') : 0;
//        $validatedData['name'] = $name;
//        $validatedData['email'] = $email;
//        $validatedData['password'] = $password;


        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
//        return response()->json([ 'user' => $request->all(), 'access_token' => $request->all()]);
    }

    public function login(Request $request)
    {
        $loginData = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }
}
