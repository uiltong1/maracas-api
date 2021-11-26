<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TaleInterface;
use App\Http\Requests\TaleRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TalesController extends Controller
{
    private $_tale;

    public function __construct(TaleInterface $_tale)
    {
        $this->_tale = $_tale;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response()->json($this->_tale->index(), Response::HTTP_OK);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaleRequest $request)
    {
        try{
            return response()->json($this->_tale->store($request), Response::HTTP_OK);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], Response::HTTP_BAD_REQUEST);
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
            return response()->json($this->_tale->show($id), Response::HTTP_OK);

        } catch(\Throwable $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaleRequest $request, $id)
    {
        try{
            return response()->json($this->_tale->update($request, $id), Response::HTTP_NO_CONTENT);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], Response::HTTP_BAD_REQUEST);
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
            $this->_tale->destroy($id);
            return response()->noContent(Response::HTTP_NO_CONTENT);

        } catch(\Exception $e){
            return response([
                'title' => 'Error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
