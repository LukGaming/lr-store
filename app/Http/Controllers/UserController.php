<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function get()
    {
        return response()->json(User::all());
    }


    public function post(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json("Usuário deletado com sucesso.", 200);
    }

    public function getById($id){
        $user = User::find($id);
        if($user == null){
            return response()->json("Usuário não encontrado.", 404);
        }
        return response()->json($user);
    }
    public function authenticate(Request $request){
        $user = User::whereRaw('user_name = ? and password = ?',
        [
            $request["user_name"],
            $request["password"]
        ])->first();
        if($user == null){
            return response()->json([
            "sucesso"=> false,
            "mensagem"=> "Usuário ou senhas incorretos",
            ], 200);
        }
        return response()->json([
            "sucesso"=> true,
            "mensagem"=> "Usuário logado com sucesso",
            "user"=>$user
        ], 200);


    }
}
