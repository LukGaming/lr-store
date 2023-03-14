<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product as ModelsProduct;
use Exception;

class ProductController extends Controller
{
    public function get()
    {
        return response()->json(ModelsProduct::all());
    }


    public function post(Request $request)
    {
        $product = ModelsProduct::create($request->all());
        return response()->json($product, 201);
    }

    public function update($id, Request $request)
    {
        $product = ModelsProduct::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function delete($id)
    {
        $product = ModelsProduct::findOrFail($id);
        $product->delete();
        return response()->json("Produto deletado com sucesso.", 200);
    }

    public function getById($id){
        $product = ModelsProduct::find($id);
        if($product == null){
            return response()->json("Produto não encontrado.", 404);
        }
        return response()->json($product);
    }
}
