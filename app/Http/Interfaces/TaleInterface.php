<?php

namespace App\Http\Interfaces;

use App\Models\Tale;

interface TaleInterface{

    function index();

    function store($tale);

    function show($id);

    function update($tale, $id);

    function destroy($id);

}