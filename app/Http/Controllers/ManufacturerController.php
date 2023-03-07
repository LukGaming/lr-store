<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manufacturer as ManufactureModel;

class ManufacturerController extends Controller
{
    public function get()
    {
        return response()->json(ManufactureModel::all());
    }


    public function post(Request $request)
    {
        $manufacture = ManufactureModel::create($request->all());
        return response()->json($manufacture, 201);
    }

    public function update($id, Request $request)
    {
        $manufacture = ManufactureModel::findOrFail($id);
        $manufacture->update($request->all());
        return response()->json($manufacture, 200);
    }

    public function delete($id)
    {
        $manufacture = ManufactureModel::findOrFail($id);
        $manufacture->delete();
        return response()->json("Fabricante deletado com sucesso.", 200);
    }

    public function getById($id){
        $manufacture = ManufactureModel::find($id);
        if($manufacture == null){
            return response()->json("Fabricante não encontrado.", 404);
        }
        return response()->json($manufacture);
    }
}
