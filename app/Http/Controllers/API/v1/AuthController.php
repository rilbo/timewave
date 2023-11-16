<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken as PersonnalAccessToken;

class AuthController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json(['status'=>true, 'message'=>'Profile utilisateur', 'data' => auth()->user()], 200,);
    }

    public function login(Request $request)
    {
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['status'=>false, 'message'=>'Erreur de connexion', 'errors'=>$validator->errors()], 422,);
            }
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['status'=>false, 'message'=>'Email ou Mot de passe incorrect', 'errors'=>$validator->errors(), 'code'=>401], 401,);
            }
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['status'=>true, 'message'=>'Connexion réussie', 'data' => [
                "token" => $token,
                "token_type" => "Bearer",
            ]], 200,);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status'=>false], 500);
        }
        
    }

    public function edit(Request $request)
    {
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'email' => 'email|unique:users,email',
            ]);
            if ($validator->fails()) {
                return response()->json(['status'=>false, 'message'=>'Erreur de connexion', 'errors'=>$validator->errors()], 422,);
            }
            $request->user()->update($inputs);
            return response()->json(['status'=>true, 'message'=>'Utilisateur modifier avec succés', 'data' => [
                "data" => $request->user(),
            ]]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status'=>false], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
            if ($validator->fails()) {
                return response()->json(['status'=>false, 'message'=>'Erreur de validation', 'errors'=>$validator->errors()], 422,);
            }
            if (!Hash::check($request->old_password, $request->user()->password)) {
                return response()->json(['status'=>false, 'message'=>"l'ancien mot de passe incorrect"], 401,);
            }
            $inputs['password'] = Hash::make($request->new_password);
            $request->user()->update($inputs);
            return response()->json(['status'=>true, 'message'=>'Mot de passe de l"utilisateur modifier avec succés', 'data' => [
                "data" => $request->user(),
            ]]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status'=>false], 500);
        }
    }

    

    public function logout(Request $request)
    {
        $accessToken = $request->bearerToken();
        $token = PersonnalAccessToken::findToken($accessToken);
        $token->delete();
        return response()->json(['status'=>true, 'message'=>'Déconnecté avec succés']);
    }
}
