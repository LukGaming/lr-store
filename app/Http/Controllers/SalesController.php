<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\ProductSaleModel;
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
        // Access the raw JSON data from the request body
        $jsonData = $request->getContent();

        // Convert the JSON data to an associative array
        $requestData = json_decode($jsonData, true);

        // Extract sale data
        $saleData = $requestData['sale'];

        // Create a new sale instance
        $sale = Sales::create([
            'sale_date' => $saleData['sale_date'],
            'sale_type' => $saleData['sale_type'],
            'user_id' => $saleData['user_id'],
            'client_id' => $saleData['client_id'],
            'payment_method_id' => $saleData['payment_method_id'],
        ]);

        // Extract product_sales data
        $productSalesData = $requestData['product_sales'];
        $createdProductSales = [];

        // Create product_sales and associate them with the sale
        foreach ($productSalesData as $productSaleData) {
            $productSale = ProductSaleModel::create([
                'product_id' => $productSaleData['product_id'],
                'serial_numbers' => json_encode($productSaleData['serial_numbers']),
                'unity_value' => $productSaleData['unity_value'],
                'quantity' => $productSaleData['quantity'],
                'sale_id' => $sale->id
            ]);

            // Add the created product_sale to the array
            $createdProductSales[] = $productSale;
        }

        $sale["product_sales"] = $createdProductSales;
            return response()->json([
                'sale' => $sale,
            ], 201);
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
