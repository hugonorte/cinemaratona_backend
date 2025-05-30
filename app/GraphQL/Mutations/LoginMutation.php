<?php
//namespace App\GraphQL\Mutations;
//
//use Illuminate\Support\Facades\Auth;
//use Tymon\JWTAuth\Facades\JWTAuth;
//
//final class LoginMutation
//{
//    public function __invoke($_, array $args)
//    {
//        $credentials = [
//            'email' => $args['email'],
//            'password' => $args['password'],
//        ];
//
//        if (!$token = Auth::guard('api')->attempt($credentials)) {
//            throw new \Exception('Invalid credentials');
//        }
//
//        $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser(Auth::user());
//
//        return [
//            'access_token' => $token,
//            'refresh_token' => $refreshToken,
//            'user' => Auth::user(),
//        ];
//    }
//}
