<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\SigninRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function signin(SigninRequest $r): JsonResponse
    {
        $data = $r->only(['email', 'password']);
        if (Auth::attempt($data)) {
            $user = Auth::user();
            $response = [
                'error' => '',
                'token' => $user->createToken('Login_token')->plainTextToken
            ];
            return response()->json($response);
        }


        return response()->json(['error' => 'Email ou/e Senha invalido']);
    }
    public function signup(CreateUserRequest $r): JsonResponse
    {
        $data = $r->only(['name', 'email', 'password', 'state_id']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $response = [
            'error' => '', //error deve vir null ou vazio para front
            'user' => $user->createToken('Register_token')->plainTextToken
            //ele retorna um objeto com varios dados do token, mas queremos apenas o valor encripitado no momento
        ];
        // como nao esta na rota de api eu n posso ter este return
        //return $user;
        //preciso trasnformar essa response em um json
        return response()->json($response);
    }
    public function me(): JsonResponse
    {
        $user = Auth::user();
        $response = [
            "id" => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'state' => $user->state->name,
            'ads' => $user->advertises
        ];

        return response()->json($response);
    }
}
