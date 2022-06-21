<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Band;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/bands",
     *     tags={"UnAuthorize"},
     *     operationId="bandsIndex",
     *     description="show all bands",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     *
     */
    public function index()
    {
        $bands = Band::all();

        return view('bands.index', [
            'bands' => $bands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *     path="/bands/create",
     *     tags={"UnAuthorize"},
     *     description="form tạo bands mới. chưa có code",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/bands/store",
     *     tags={"UnAuthorize"},
     *     operationId="bandsStore",
     *     description="lưu vào db bands mới. chưa có code",
     *     @OA\RequestBody(
     *          required=true,
     *      ),
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/bands/{id}",
     *     tags={"UnAuthorize"},
     *     description="view thông tin bands mới. chưa có code",
     *     summary="get user detail",
        *  @OA\Parameter(
        *     name="id",
        *     in="path",
        *     description="id that need to be fetched",
        *     required=true,
        *     example=1,
            * @OA\Schema(
     *           type="integer",
     *        )
        *   ),
        *   @OA\Response(response=200, description="successful operation"),
        *   @OA\Response(response=400, description="Invalid Band id supplied"),
        *   @OA\Response(response=404, description="Band not found")
     * )
     *
     */
    public function show($id)
    {
        //
        $band = Band::find($id);

        return view('bands.show', [
            'band' => $band
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/bands/{id}/edit",
     *     tags={"Authorize"},
     *     description="form sửa thông tin bands. chưa có code",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Put(
     *     path="/bands/{id}",
     *     tags={"Authorize"},
     *     description="lưu vào db thông tin sửa bands. chưa có code",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *     path="/bands/{id}",
     *     tags={"Authorize"},
     *     description="xóa khỏi db thông tin bands. chưa có code",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function destroy($id)
    {
        //
    }
}
