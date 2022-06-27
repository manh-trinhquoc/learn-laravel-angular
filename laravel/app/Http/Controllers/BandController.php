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
     *     tags={"Bands"},
     *     description="show all bands",
     *     summary="List Bands",
     *     @OA\Response(
            * response="200",
            * description="Hiện danh sách các bands",
        * ),
        *     @OA\Response(
            * response="404",
            * description="Not found",
        * ),
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
     *     tags={"Bands"},
     *     description="form tạo bands mới. chưa có code",
     *     summary="Tạo band mới",
     *     @OA\Response(response="200", description="Form tạo Band")
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
     *     tags={"Bands"},
     *     description="lưu vào db bands mới. chưa có code",
     *     summary="Create Band",
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/components/schemas/Band"),
 *          )
 *      ),
        * @OA\Response(
            * response=201,
            * description="Success: A Newly Created Band",
            * @OA\Schema(ref="#/components/schemas/Band")
        * ),
        * @OA\Response(
            * response="422",
            * description="Missing mandatory field"
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * )
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
     *     tags={"Bands"},
     *     description="view thông tin bands qua id",
     *     summary="get band detail",
        * security={
            * { "api_key":{} }
        * },
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
        *   @OA\Response(response=200, description="render thông tin của band"),
        *   @OA\Response(response=404, description="Band not found")
     * )
     *
     */
    public function show($id)
    {
        //
        $band = Band::find($id);
        if ($band == null) {
            return abort(404, 'Không tìm thấy dữ liệu band');
        }

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
     *     tags={"Bands"},
     *     description="form sửa thông tin bands. chưa có code",
     *     summary="form sửa bands",
     *     @OA\Parameter(
        *     name="id",
        *     in="path",
        *     description="id that need to be fetched",
        *     required=true,
        *     example=1,
            * @OA\Schema(
     *           type="integer",
     *        )
        *   ),
     *     @OA\Response(response="200", description="Form sửa band"),
     *     @OA\Response(response=400, description="Invalid Band id supplied"),
     *     @OA\Response(response=404, description="Band not found")
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
     *     tags={"Bands"},
     *     description="lưu vào db thông tin sửa bands. chưa có code",
     *     summary="update band",
     *     @OA\Parameter(
        *     name="id",
        *     in="path",
        *     description="id that need to be fetched",
        *     required=true,
        *     example=1,
            * @OA\Schema(
    *           type="integer",
    *        )
        *   ),
     *      @OA\RequestBody(
        *       @OA\JsonContent(
            *       @OA\Schema(ref="#/components/schemas/Band"),
    *          )
    *      ),
        * @OA\Response(
            * response=200,
            * description="Success: Return the Band updated",
            * @OA\Schema(ref="#/components/schemas/Band")
        * ),
        * @OA\Response(
            * response="422",
            * description="Missing mandatory field"
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * ),
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
     *     tags={"Bands"},
     *     description="xóa khỏi db thông tin bands. chưa có code",
     *      summary="delete band",
     *     @OA\Parameter(
            * description="band id to delete",
            * in="path",
            * name="id",
            * required=true,
            * @OA\Schema(
        *         type="integer",
        *     ),
        * ),
        * @OA\Response(
            * response=404,
            * description="Not found"
        * ),
        * @OA\Response(
            * response=204,
            * description="Success: successful deleted"
        * ),
     * )
     */
    public function destroy($id)
    {
        //
    }
}
