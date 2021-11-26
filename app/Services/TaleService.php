<?php

namespace App\Services;

use App\Http\Interfaces\TaleInterface;
use App\Models\Tale;
use Exception;

class TaleService implements TaleInterface{

    function index()
    {
        return Tale::latest('created_at')->paginate(10);
    }

    function store($tale)
    {
        return Tale::create($tale->all());
    }

    function show($id)
    {
        $tale = Tale::find($id);
        return $this->validateExistTale($tale);
    }

    function update($tale, $id)
    {
        $taleExist = Tale::find($id);
        $this->validateExistTale($taleExist);
        return $taleExist->update($tale->all());
    }

    function destroy($id)
    {
        $tale = Tale::findOrFail($id);
        return $tale->delete();
    }

    private function validateExistTale($tale)
    {
        if(!$tale){
            throw new Exception("Registro não encontrado.", 404);
        }
        return $tale;
    }
   
}