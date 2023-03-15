<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Exception;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function get()
    {
        return response()->json(Sales::all());
    }


    public function post(Request $request)
    {
        $sale = Sales::create($request->all());
        return response()->json($sale, 201);
    }

    public function update($id, Request $request)
    {

        $sale = Sales::findOrFail($id);
        $sale->update($request->all());

        return response()->json($sale, 200);
    }

    public function delete($id)
    {
        $sale = Sales::findOrFail($id);
        $sale->delete();
        return response()->json("Venda deletada com sucesso.", 200);
    }

    public function getById($id){
        $sale = Sales::find($id);
        if($sale == null){
            return response()->json("Venda não encontrado.", 404);
        }
        return response()->json($sale);
    }
}
