<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\MediaInterface;
use App\Http\Requests\MediaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\Cast\Array_;

class MediasController extends Controller
{
    private $_media;

    public function __construct(MediaInterface $_media)
    {
        $this->_media = $_media;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response()->json($this->_media->index(), Response::HTTP_OK);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ],  $e->getCode() ??  Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        try{
            return response()->json($this->_media->store($request), Response::HTTP_OK);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ],  $e->getCode() ??  Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{            
            return response()->download($this->_media->show($id));

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ],  Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MediaRequest $request, $id)
    {
        try{
            return response()->json($this->_media->update($request, $id), Response::HTTP_NO_CONTENT);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ], $e->getCode() ??  Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            return response()->json($this->_media->destroy($id), Response::HTTP_NO_CONTENT);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ],  $e->getCode() ??  Response::HTTP_BAD_REQUEST);
        }
    }
}
