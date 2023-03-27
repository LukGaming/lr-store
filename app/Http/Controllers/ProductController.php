<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

use App\Models\Product as ModelsProduct;
use Exception;

class ProductController extends Controller
{
    public function get()
    {
        $products = ModelsProduct::all();
        foreach ($products as $product) {
            $product->manufacturer =  Manufacturer::findOrFail($product->manufacture_id);
        }
        return response()->json($products);
    }


    public function post(Request $request)
    {
        $product = ModelsProduct::create($request->all());
        $product->manufacturer = Manufacturer::findOrFail($product->manufacture_id);
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
