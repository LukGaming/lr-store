<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Manufacturer;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductSaleModel;
use App\Models\Sales;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function get()
    {
        $sales = Sales::all();
        $salesData = [];
        foreach ($sales as $sale) {
            $sale->quantity = 0;
            $sale->total_value = 0;
            $sale->user = User::findOrFail($sale->user_id);
            $sale->payment_method = PaymentMethod::findOrFail($sale->payment_method_id);
            $sale->client = Client::findOrFail($sale->payment_method_id);
            $productSales = ProductSaleModel::where('sale_id', $sale->id)->get();
            foreach ($productSales as $productSale) {
                $sale->total_value += $productSale->quantity * $productSale->unity_value;
                $sale->quantity += $productSale->quantity;
            }
            $saleData = $sale->toArray();
            $saleData['product_sales'] = $productSales->toArray();
            $salesData[] = $saleData;
        }
        return response()->json(
            [
                'sales' => $salesData,
            ],
            200
        );
    }


    public function post(Request $request)
    {
        $jsonData = $request->getContent();
        $requestData = json_decode($jsonData, true);
        $saleData = $requestData['sale'];
        $sale = Sales::create([
            'sale_date' => $saleData['sale_date'],
            'sale_type' => $saleData['sale_type'],
            'user_id' => $saleData['user_id'],
            'client_id' => $saleData['client_id'],
            'payment_method_id' => $saleData['payment_method_id'],
        ]);
        $productSalesData = $requestData['product_sales'];
        $createdProductSales = [];
        foreach ($productSalesData as $productSaleData) {
            $productSale = ProductSaleModel::create([
                'product_id' => $productSaleData['product_id'],
                'serial_numbers' => json_encode($productSaleData['serial_numbers']),
                'unity_value' => $productSaleData['unity_value'],
                'quantity' => $productSaleData['quantity'],
                'sale_id' => $sale->id
            ]);
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

    public function getById($id)
    {
        $sale = Sales::find($id);
        if ($sale == null) {
            return response()->json("Venda não encontrado.", 404);
        }
        return response()->json($sale);
    }
}
