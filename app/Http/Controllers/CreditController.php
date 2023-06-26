<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return response()->json(Credit::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $creditData = $request->json()->all();
        $credit = Credit::create($creditData);

        return response()->json($credit, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $credit = Credit::find($id);

        if ($credit) {
            return response()->json($credit, 200);
        }

        return response()->json(['message' => 'Credit not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $credit = Credit::find($id);

        if ($credit) {
            $credit->update($request->all());
            return response()->json($credit, 200);
        }

        return response()->json(['message' => 'Credit not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $credit = Credit::find($id);

        if ($credit) {
            $credit->delete();
            return response()->json(['message' => 'Credit deleted successfully'], 200);
        }

        return response()->json(['message' => 'Credit not found'], 404);
    }
}
