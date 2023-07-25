<?php

namespace App\Http\Controllers;

use App\Models\Debit;
use Illuminate\Http\Request;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return response()->json(Debit::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $debitData = $request->json()->all();
        $debit = Debit::create($debitData);

        return response()->json($debit, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $debit = Debit::find($id);

        if ($debit) {
            return response()->json($debit, 200);
        }

        return response()->json(['message' => 'Debit not found'], 404);
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
        $debit = Debit::find($id);

        if ($debit) {
            $debit->update($request->all());
            return response()->json($debit, 200);
        }

        return response()->json(['message' => 'Debit not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $debit = Debit::find($id);

        if ($debit) {
            $debit->delete();
            return response()->json(['message' => 'Debit deleted successfully'], 200);
        }
        return response()->json(['message' => 'Debit not found'], 404);
    }
}
