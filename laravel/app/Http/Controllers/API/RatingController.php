<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Bike;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{
    /**
    * Protect update and delete methods, only for authenticated users.
    *
    * @return Unauthorized
    */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        * path="/api/bikes/{bike_id}/ratings",
        * tags={"Ratings"},
        * summary="rating a Bike",
        * @OA\Parameter(
            * in="path",
            * name="id",
            * required=true,
            * @OA\Schema(
        *         type="integer",
        *     ),
            * description="Bike Id"
        * ),
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/definitions/Rating"),
 *          )
 *      ),
        * @OA\Response(
            * response=201,
            * description="Success: A Newly Created Rating",
            * @OA\Schema(ref="#/definitions/Rating")
        * ),
        * @OA\Response(
            * response=401,
            * description="Refused: Unauthenticated"
        * ),
        * @OA\Response(
            * response="422",
            * description="Missing mandatory field"
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * ),
        * @OA\Response(
            * response="405",
            * description="Invalid HTTP Method"
        * ),
        * security={
            * { "api_key":{} }
        * }
    * ),
     */
    public function store(Request $request, Bike $bike)
    {
        $rating = Rating::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'bike_id' => $bike->id,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return new RatingResource($rating);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     */
    public function destroy($id)
    {
        //
    }
}
