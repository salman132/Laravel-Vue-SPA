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
           return response()->json(['message','Access denied'],403);
       }

       $user = $request->user();

       $tokenResult = $user->createToken('Personal Access Token');
       $token = $tokenResult->token;

       if($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
       }

       $token->save();
       return response()->json(['success','Login Successful',400]);
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
       }
       catch (\Exception $exception){
           return response()->json($exception->getMessage());
       }
       return response()->json(['message' => 'Registration Success']);
   }

}
