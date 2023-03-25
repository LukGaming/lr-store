<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
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
    public function getAllSales(Request $request){
        $sales = Sales::all();
        $totalSales = 0;
        foreach ($sales as $sale) {
            $sale->product;

            $sale->product->manufecturer =  Manufacturer::findOrFail($sale->product->manufacture_id);
            $sale->payment_method;
            $sale->client;
            $sale->user;
            $totalSales += $sale->quantity * $sale->unity_value;
        }

        return response()->json([
            "sucesso"=> true,
            "mensagem"=>"vendas recuperadas com sucesso",
            "vendas"=> $sales,
            "valorTodalDeVendas"=> $totalSales
        ]);
    }
}
