<?php

namespace App\Http\Controllers;

use App\Models\InterestRates;
use Illuminate\Http\Request;

class InterestRatesController extends Controller
{
    public function get()
    {
        return response()->json(InterestRates::all());
    }


    public function post(Request $request)
    {
        $interestRate = InterestRates::create($request->all());
        return response()->json($interestRate, 201);
    }

    public function update($id, Request $request)
    {
        $interestRate = InterestRates::findOrFail($id);
        $interestRate->update($request->all());

        return response()->json($interestRate, 200);
    }

    public function delete($id)
    {
        $interestRate = InterestRates::findOrFail($id);
        $interestRate->delete();
        return response()->json("Parcelamento deletado com sucesso.", 200);
    }

    public function getById($id){
        $interestRate = InterestRates::find($id);
        if($interestRate == null){
            return response()->json("Parcelamento não encontrado.", 404);
        }
        return response()->json($interestRate);
    }
}
