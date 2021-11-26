<?php

namespace App\Services;

use App\Http\Interfaces\MediaInterface;
use App\Models\Media;
use Error;
use Exception;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class MediaService implements MediaInterface{
    
    function index()
    {
        return Media::latest('created_at')->paginate(10);
    }

    function store($media)
    {
       if($file = $media->file('file')){
            $data = array();
            $data['name'] = $file->getClientOriginalName();
            $data['description'] = $media->description;
            $data['path'] = $file->store('file');

            return Media::create($data);
       }
    }

    function show($id)
    {
        $media = Media::find($id);
        $this->validateMediaExist($media);
    
        $file_path = storage_path() . '\app\\'. $media->path;
        if(file_exists($file_path)){
            return $file_path;
        }

        throw new Exception("Nenhum arquivo encontrado.", 404);
    }

    function update($media, $id)
    {
        $mediaExist = Media::find($id);
        $this->validateMediaExist($mediaExist);

        $this->deleteFile($mediaExist->path);
        if($file = $media->file('file')){
            $data = array();
            $data['name'] = $file->getClientOriginalName();
            $data['description'] = $media->description;
            $data['path'] = $file->store('file');
        }
        return $mediaExist->update($data);
    }

    function destroy($id)
    {
        $media = Media::find($id);
        $this->validateMediaExist($media);
        $this->deleteFile($media->path);
        $media->delete();   
    }

    private function validateMediaExist($media)
    {
        if(!$media){
            throw new Exception("Registro não encontrado.", 404);
        }
    }

    private function deleteFile($path)
    {
        if($path){
            $file_path = storage_path() . '\app\\'. $path;
            if(file_exists($file_path)){
                File::delete($file_path);
            }
        }
    }
}