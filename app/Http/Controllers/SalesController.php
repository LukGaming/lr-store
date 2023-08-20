<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Manufacturer;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductSaleModel;
use App\Models\sale_selected_credit_payment;
use App\Models\Sales;
use App\Models\SaleSelectedDebit;
use App\Models\User;
use Brick\Math\BigInteger;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class SalesController extends Controller
{
    public function get()
    {
        $sales = Sales::all();
        $salesData = [];
        foreach ($sales as $sale) {
            $sale->user = User::findOrFail($sale->user_id);
            $sale->client = Client::findOrFail($sale->client_id);

            if ($sale->payment_method == 2) {
                $sale->selectedPaymentMethod  = sale_selected_credit_payment::where('sale_id', $sale->id)->first();
            }

            if ($sale->payment_method == 3) {
                $sale->selectedPaymentMethod = SaleSelectedDebit::where('sale_id', $sale->id)->first();
            }
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
        $requestData = $request->json()->all();
        $sale = Sales::create([
            'sale_date' => $requestData['saleDate'],
            'sale_type' => $requestData['selectedSalesType'],
            'user_id' => $requestData['userId'],
            'client_id' => $requestData['selectedClient']['id'],
            'payment_method' => $requestData['paymentMethod'],
        ]);

        if ($requestData['paymentMethod'] == 2) {
            $selectedPaymentMethod = sale_selected_credit_payment::create([
                'sale_id' => $sale->id,
                'credit_table_id' => $requestData['selectedPaymentMethod']['id'],
            ]);
        }

        if ($requestData['paymentMethod'] == 3) {
            $selectedPaymentMethod = SaleSelectedDebit::create([
                'sale_id' => $sale->id,
                'debit_table_id' => $requestData['selectedPaymentMethod']['id'],
            ]);
        }

        $createdProductSales = [];
        foreach ($requestData['products'] as $productData) {
            $productSale = ProductSaleModel::create([
                'product_id' => $productData['selectedProduct']['id'],
                'serial_numbers' => json_encode($productData['serialNumbers']),
                'unity_value' => $productData['unityValue'],
                'quantity' => $productData['quantity'],
                'sale_id' => $sale->id
            ]);
            $createdProductSales[] = $productSale;
        }

        $sale["product_sales"] = $createdProductSales;

        return response()->json(
            [
                'sale' => $sale,
            ],
            201
        );
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
            return response()->json("Venda não encontrada.", 404);
        }

        $sale->user = User::findOrFail($sale->user_id);
        $sale->client = Client::findOrFail($sale->client_id);
        $productSales = ProductSaleModel::where('sale_id', $sale->id)->get();

        if ($sale->payment_method == 2) {
            $sale->selectedPaymentMethod  = sale_selected_credit_payment::where('sale_id', $sale->id)->first();
        }

        if ($sale->payment_method == 3) {
            $sale->selectedPaymentMethod = SaleSelectedDebit::where('sale_id', $sale->id)->first();
        }

        foreach ($productSales as $productSale) {
            $sale->total_value += $productSale->quantity * $productSale->unity_value;
            $sale->quantity += $productSale->quantity;
        }

        $saleData = $sale->toArray();
        $saleData['product_sales'] = $productSales->toArray();

        return response()->json($saleData, 200);
    }
}
