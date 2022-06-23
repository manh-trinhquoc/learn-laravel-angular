<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
        * path="/api/items",
        * tags={"Items"},
        * summary="List Items",
        * @SWG\Response(
            * response=200,
            * description="Success: List all Items",
            * @SWG\Schema(ref="#/definitions/Item")
        * ),
        * @SWG\Response(
            * response="404",
            * description="Not Found"
        * )
    * ),
     */
    public function index()
    {
        $listItems = Item::all();

        return $listItems;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
* path="/api/items",
* tags={"Items"},
* summary="Create Item",
* @SWG\Parameter(
* name="body",
* in="body",
* required=true,
* @SWG\Schema(ref="#/definitions/Item"),
* description="Json format",
* ),
* @SWG\Response(
* response=201,
* description="Success: A Newly Created Item",
* @SWG\Schema(ref="#/definitions/Item")
* ),
* @SWG\Response(
* response="422",
* description="Missing mandatory field"
* ),
* @SWG\Response(
* response="404",
* description="Not Found"
* )
* ),
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
