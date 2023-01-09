<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request){
        try {
            $user = User::create($request->all());

            return  response([
                "message" => "Usuário Cadatrado Com Sucesso!",
                "data" => $user,
                "errors" => null
            ], 201);

        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Cadastrar Usuário!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }

    public function login(AuthLoginRequest $request){
        try {

            if(!auth()->attempt($request->validated())){
                return  response([
                    "message" => "Senha Incorreta!",
                    "data" => null,
                    "errors" => [
                        "password" => [
                            __('auth.password')
                        ],
                    ]
                ], 201);
            }

            $token = $request->user()->createToken('login');

            return  response([
                "message" => "Usuário Logado Com Sucesso!",
                "data" => [
                    'user' => auth()->user(),
                    'token' => $token->plainTextToken
                ],
                "errors" => null
            ], 201);

        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Logar Usuário!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }

    public function logout(Request $request){
        try {
            $request->user()->currentAccessToken()->delete();

            return response([
                "message" => 'Usuário Deslogado Com Sucesso!',
                "data" => null,
                "errors" => null,
            ], 201);

        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Deslogar Usuário!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }
}
