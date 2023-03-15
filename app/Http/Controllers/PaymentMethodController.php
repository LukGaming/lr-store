<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function get()
    {
        return response()->json(PaymentMethod::all());
    }


    public function post(Request $request)
    {
        $paymentMethod = PaymentMethod::create($request->all());
        return response()->json($paymentMethod, 201);
    }

    public function update($id, Request $request)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update($request->all());
        return response()->json($paymentMethod, 200);
    }

    public function delete($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();
        return response()->json("Método de pagamento deletado com sucesso.", 200);
    }

    public function getById($id){
        $paymentMethod = PaymentMethod::find($id);
        if($paymentMethod == null){
            return response()->json("Método de pagamento não encontrado.", 404);
        }
        return response()->json($paymentMethod);
    }
}
