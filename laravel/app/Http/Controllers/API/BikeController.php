<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;
use Validator;
use App\Http\Resources\BikesResource;

class BikeController extends Controller
{
    /**
    * Protect update and delete methods, only for authenticated    users.
    *
    * @return Unauthorized
    */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

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
            * @OA\JsonContent(
               * examples = {
                    * "example": @OA\Schema(ref="#/components/examples/BikeEx1", example="1"),
               * }
            * ),
            *
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * ),
        * @SWG\Response(
            * response="405",
            * description="Invalid HTTP Method"
        * )
    * ),
     */
    public function index()
    {
        $listBikes = Bike::all();

        // return $listBikes;
        // Using Paginate
        return BikesResource::collection(Bike::with('ratings')->paginate(10));
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
        *       @OA\Schema(ref="#/components/schemas/Bike"),
 *          )
 *      ),
        * @OA\Response(
            * response=201,
            * description="Success: A Newly Created Bike",
            * @OA\Schema(ref="#/components/schemas/Bike")
        * ),
        * @SWG\Response(
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
        * @SWG\Response(
        * response="405",
        * description="Invalid HTTP Method"
        * ),
        * security={
            * { "api_key":{} }
        * }
    * ),
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'mods' => 'required',
            'builder_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $createBike = Bike::create($request->all());

        // return $createBike;

        // Creating a record in a different way
        $createBike = Bike::create([
            'user_id' => $request->user()->id,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'mods' => $request->mods,
            'picture' => $request->picture,
        ]);

        return new BikesResource($createBike);
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
            * @OA\JsonContent(
                * @OA\Schema(ref="#/components/schemas/Bike"),
                * examples = {
                    * "example": @OA\Schema(ref="#/components/examples/BikeEx2", example="1"),
                * }
            * ),
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * ),
        * @SWG\Response(
            * response="405",
            * description="Invalid HTTP Method"
        * ),
        * security={
            * { "api_key":{} }
        * }
    * ),
     */
    public function show(Bike $bike)
    {
        $showBikeById = Bike::with(['items', 'builder', 'garages'])->findOrFail($id);

        // return $showBikeById;

        return new BikesResource($bike);
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
            * @OA\Schema(
        *         type="integer",
        *     ),
            * description="Update the specified bike by id.",
        * ),
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/components/schemas/Bike"),
                * examples = {
                    * "example": @OA\Schema(ref="#/components/examples/BikeEx2", example="1"),
                * }
 *          )
 *      ),
        * @OA\Response(
            * response=200,
            * description="Success: Return the Bike updated",
            * @OA\JsonContent(
                * @OA\Schema(ref="#/components/schemas/Bike"),
                * examples = {
                    * "example": @OA\Schema(ref="#/components/examples/BikeEx2", example="1"),
                * }
            * ),
        * ),
        * @OA\Response(
            * response="422",
            * description="Missing mandatory field"
        * ),
        * @OA\Response(
            * response="404",
            * description="Not Found"
        * ),
        * @SWG\Response(
            * response="403",
            * description="Forbidden"
        * ),
        * @SWG\Response(
            * response="405",
            * description="Invalid HTTP Method"
        * ),
        * security={
            * {"api_key":{} }
        * }
    * ),
     */
    public function update(Request $request, Bike $bike)
    {
        $validator = Validator::make($request->all(), [
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'mods' => 'required',
            'builder_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $updateBikeById = Bike::findOrFail($id);
        // $updateBikeById->update($request->all());

        // return $updateBikeById;
        // check if currently authenticated user is the bike owner
        if ($request->user()->id !== $bike->user_id) {
            return response()->json(['error' => 'You can only edit     your     own bike.'], 403);
        }
        $bike->update($request->only(['make', 'model', 'year',    'mods', 'picture']));

        return new BikesResource($bike);
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
        * @SWG\Response(
            * response="405",
            * description="Invalid HTTP Method"
        * ),
        * security={
            * { "api_key":{} }
        * }
    * )
     */
    public function destroy($id)
    {
        $deleteBikeById = Bike::find($id)->delete();

        return response()->json([], 204);
    }
}
