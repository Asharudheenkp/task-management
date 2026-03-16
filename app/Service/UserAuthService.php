<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAuthService
{
    public function register($request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return ['status' => true, 'message' => 'User registration successfull'];
        } catch (\Throwable $th) {
            return ['status' => false, 'message' => 'Someting went wrong, Please try again later'];
        }
    }

    public function login($request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken($user->id)->plainTextToken;
            
         return ['status' => true, 'message' => 'User login successfull', 'token' => $token];
    }

}
