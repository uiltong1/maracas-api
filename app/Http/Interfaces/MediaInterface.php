<?php

namespace App\Http\Interfaces;

interface MediaInterface{
    
    function index();

    function store($media);

    function show($id);

    function update($media, $id);

    function destroy($id);
}