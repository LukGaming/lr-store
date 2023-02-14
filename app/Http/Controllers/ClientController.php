<?php

namespace App\Http\Controllers;


use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function get()
    {
        return response()->json(Client::all(), 201);
    }
    public function post(Request $request)
    {
        return response()->json(Client::create($request->all()), 200);
    }
    public function update($id, Request $request)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return response()->json($client, 200);
    }
    public function delete($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json("Cliente deletado com sucesso.", 200);
    }

}