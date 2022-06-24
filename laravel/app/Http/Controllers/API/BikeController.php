<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bike;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
        * path="/api/bikes",
        * tags={"Bikes"},
        * summary="List Bikes",
        * @OA\Response(
            * response=200,
            * description="Success: List all Bikes",
            * @OA\Schema(ref="#/definitions/Bike")
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * )
    * ),
     */
    public function index()
    {
        $listBikes = Bike::all();

        return $listBikes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
        * path="/api/bikes",
        * tags={"Bikes"},
        * summary="Create Bike",
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/definitions/Bike"),
 *          )
 *      ),
        * @OA\Response(
            * response=201,
            * description="Success: A Newly Created Bike",
            * @OA\Schema(ref="#/definitions/Bike")
        * ),
        * @OA\Response(
            * response="422",
            * description="Missing mandatory field"
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * )
    * ),
     */
    public function store(Request $request)
    {
        $createBike = Bike::create($request->all());

        return $createBike;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
        * path="/api/bikes/{id}",
        * tags={"Bikes"},
        * summary="Get Bike by Id",
        * @OA\Parameter(
            * name="id",
            * in="path",
            * required=true,
            * @OA\Schema(
        *         type="integer",
        *     ),
            * description="Display the specified bike by id.",
        * ),
        * @OA\Response(
            * response=200,
            * description="Success: Return the Bike",
            * @OA\Schema(ref="#/definitions/Bike")
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * )
    * ),
     */
    public function show($id)
    {
        $showBikeById = Bike::with(['items', 'builder', 'garages'])->findOrFail($id);

        return $showBikeById;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Put(
        * path="/api/bikes/{id}",
        * tags={"Bikes"},
        * summary="Update Bike",
        * @OA\Parameter(
            * name="id",
            * in="path",
            * required=true,
            * type="integer",
            * description="Update the specified bike by id.",
        * ),
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/definitions/Bike"),
 *          )
 *      ),
        * @OA\Response(
            * response=200,
            * description="Success: Return the Bike updated",
            * @OA\Schema(ref="#/definitions/Bike")
        * ),
        * @OA\Response(
            * response="422",
            * description="Missing mandatory field"
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * )
    * ),
     */
    public function update(Request $request, $id)
    {
        $updateBikeById = Bike::findOrFail($id);
        $updateBikeById->update($request->all());

        return $updateBikeById;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
        * path="/api/bikes/{id}",
        * tags={"Bikes"},
        * summary="Delete bike",
        * description="Delete the specified bike by id",
        * @OA\Parameter(
            * description="Bike id to delete",
            * in="path",
            * name="id",
            * required=true,
            * type="integer",
            * format="int64"
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
        $deleteBikeById = Bike::find($id)->delete();

        return response()->json([], 204);
    }
}
