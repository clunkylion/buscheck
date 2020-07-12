<?php

namespace App\Http\Controllers;

use App\People;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::join('people', 'people.id', '=', 'users.peopleId')
        ->select('users.*', 'people.rut', 'people.name', 'people.lastName', 'people.phone', 'people.email')->get();
        return response()->json([
            "Data" => [
               "user" => $user,
            ],
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::join('people', 'people.id', '=', 'users.peopleId')
        ->select('users.*', 'people.rut', 'people.name', 'people.lastName', 'people.phone', 'people.email', 'people.dateBirth')->where('users.id', '=', $id)->get();
        if ($user->isEmpty()) {
            return response()->json([
                "message" => "No encontrado",
                "status" => Response::HTTP_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);  
        }else{
            return response()->json([
                "data" => $user,
                "status" => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        $user = User::findOrFail($id);
        $peopleId = $user->peopleId;
        $people = People::find($peopleId);
        $people->update([
            "rut" => $request->input('rut'),
            "name" => $request->input('name'),
            "lastName" => $request->input('lastName'),
            "phone" => $request->input('phone'),
            "email" => $request->input('email'),
            "sex" => $request->input('sex'),
            "dateBirth" => $request->input('dateBirth'),
        ]);
        $user->update([
            "username" => $request->input('username'),
            "password" => Hash::make($request->input('password')),
            "role" => $request->input('role'),
        ]);
        return response()->json([
            "message" => "Usuario actualizado correctamente",
            "data" => [
                "people" => $people,
                "user" => $user 
            ],
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $peopleId = $user->peopleId;
        $people = People::find($peopleId);
        $people->delete();
        $user->delete();
        return response()->json([
            "message" => "Usuario eliminado Correctamente",
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }
}
