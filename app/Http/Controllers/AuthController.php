<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function loginApp(Request $request){
        $user = User::where('username', $request->username)->where('role', 'Usuario')->orWhere('role', 'Auxiliar')->first();
        if ($user) {
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('User Token')->accessToken;
                return response()->json([
                    "message" => "Bienvenido: ".$user->username,
                    "token" => $token,
                    "status" => Response::HTTP_OK
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    "message" => "Contraseña o Nombre de Usuario Incorrectos",
                    "status" => 401
                ], 401);
            }
        } else {
            return response()->json([
                "message" => "Nombre de Usuario no existe",
                "status" => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function loginWeb(Request $request){
        $user = User::where('username', $request->username)->where('role', 'Administrador')->first();
        if ($user) {
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('User Token')->accessToken;
                return response()->json([
                    "message" => "Bienvenido: ".$user->username,
                    "token" => $token,
                    "status" => Response::HTTP_OK
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    "message" => "Contraseña o Nombre de Usuario Incorrectos",
                    "status" => 401
                ], 401);
            }
        } else {
            return response()->json([
                "message" => "Nombre de Usuario no existe",
                "status" => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function signup (Request $request){
        $people = People::create([
            "rut" => $request->input('rut'),
            "name" => $request->input('name'),
            "lastName" => $request->input('lastName'),
            "phone" => $request->input('phone'),
            "email" => $request->input('email'),
            "sex" => $request->input('sex'),
            "dateBirth" => $request->input('dateBirth'),
        ]);
        $user = User::create([
            "username" => $request->input('username'),
            "password" => Hash::make($request->input('password')),
            "lastSession" => $request->input('lastSession'),
            "role" => $request->input('role'),
            "userStatus" => $request->input('userStatus'),
            "enterpriseId" => $request->input('enterpriseId'),
            "busId" => $request->input('busId'),
            "peopleId" => $people->id
        ]);
        return response()->json([
            "message" => "Usuario creado correctamente", 
            "data" => [
                "people" => $people,
                "user" => $user
            ],
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }
}
