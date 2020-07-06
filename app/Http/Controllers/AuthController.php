<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function loginApp(Request $request){
        $user = User::where('username', $request->username)->where('role', 'Usuario')->first();
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
                    "status" => Response::HTTP_BAD_REQUEST
                ], Response::HTTP_BAD_REQUEST);
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
                    "status" => Response::HTTP_BAD_REQUEST
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                "message" => "Nombre de Usuario no existe",
                "status" => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
