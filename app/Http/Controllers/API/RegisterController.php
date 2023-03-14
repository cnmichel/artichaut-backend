<?php

namespace App\Http\Controllers\API;

use App\Notifications\NewUserCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email|unique:users',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2,
                //remplace les / par des lettres s pour éviter que l'url ne comprenne pas
                'hash' => str_replace('/', 's', Hash::make(Str::random(10)))
             ]);

         $user->notify(new NewUserCreated($user));

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email ou mot de passe incorrecte'
                ], 401);
            }

            $user = Auth::user();
            return response()->json([
                'status' => true,
                'message' => 'Connexion réussie',
                'email' => $user->email,
                'role' => $user->role_id,
                'token' => $user->createToken('ArtichautApp')->plainTextToken,

            ], 200);

        }catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokeToken()
    {
        if (Auth::guard('sanctum')->check()) {
            Auth::guard('sanctum')->user()->tokens()->delete();
            return response()->json(['status' => true],200);
        }
        return response()->json(['status' => false], 401);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyToken()
    {
        if (Auth::guard('sanctum')->check()) {
            return response()->json(['status' => true],200);
        }
        return response()->json(['status' => false], 401);
    }

    public function getUserByToken()
    {
        $user =  Auth::guard('sanctum')->user();
        return response()->json(['user' => $user]);
    }

    public function verifyEmail($hash)
    {
        $user = User::where('hash', $hash)->first();
        $user->email_verified_at = now();
        $user->save();
        return Redirect::to('http://localhost:5174/login');
    }

}
