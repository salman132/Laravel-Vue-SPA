<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
   public function login(Request $request){
       $request->validate([
           'email' => 'required|string|email',
           'password' => 'required|string',
           'remember_me' => 'boolean'
       ]);


       $credentials = request(['email','password']);

       if(!Auth::attempt($credentials)){
           return response()->json(['message'=>'Access denied']);
       }

       $user = $request->user();

       $token = $user->createToken('Laravel Password Grant Client')->accessToken;
       $response = ['token' => $token];


       if($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
       }

       return response()->json($response);
   }

   public function register(Request $request){


       $request->validate([
           'name' => 'required|string',
           'email' => 'required|string|email|unique:users',
           'password' => 'required|string'
       ]);


       try{
           $user = new User();
           $user->name = $request->name;
           $user->email = $request->email;
           $user->password = Hash::make($request->password);
           $user->save();

           $token = $user->createToken('Laravel Password Grant Client')->accessToken;
           $response = ['token' => $token];
       }
       catch (\Exception $exception){
           return response()->json($exception->getMessage());
       }
       return response()->json(['message' => 'Registration Success']);
   }

   public function logout(Request $request){
       $request->user()->token()->revoke();

       return response()->json([
           'message' => 'Successfully logged out'
       ]);
   }

}
