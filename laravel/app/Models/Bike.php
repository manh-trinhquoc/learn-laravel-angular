<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* @OA\Schema(
    * schema="Bike",
    * required={"make", "model", "year", "mods"},
    * @OA\Property(
        * property="make",
        * type="string",
        * description="Company name",
        * example="Harley Davidson, Honda, Yamaha"
    * ),
    * @OA\Property(
        * property="model",
        * type="string",
        * description="Motorcycle model",
        * example="Xl1200, Shadow ACE, V-Star"
    * ),
    * @OA\Property(
        * property="year",
        * type="string",
        * description="Fabrication year",
        * example="2009, 2008, 2007"
    * ),
    * @OA\Property(
        * property="mods",
        * type="string",
        * description="Motorcycle description of modifications",
        * example="New exhaust system"
    * ),
    * @OA\Property(
        * property="picture",
        * type="string",
        * description="Bike image URL",
        * example="http://www.sample.com/my.bike.jpg"
    * ),
* ),
* @OA\Examples(
*   summary="Bike example 1",
*   example = "BikeEx1",
*   value = {
        * {
            * "make": "Honda",
            * "model": "Shadow ACE",
            * "year": "2007",
            * "mods": "New exhaust system",
            * "picture": "http://www.sample.com/my.bike.jpg"
        * },
        * {
            * "make": "Honda",
            * "model": "Shadow ACE",
            * "year": "2007",
            * "mods": "New exhaust system",
            * "picture": "http://www.sample.com/my.bike.jpg"
        * }
*   },
* ),
* @OA\Examples(
*   summary="Bike example 2",
*   example = "BikeEx2",
*   value = {
        * "make": "Honda",
        * "model": "Shadow ACE",
        * "year": "2007",
        * "mods": "New exhaust system",
        * "picture": "http://www.sample.com/my.bike.jpg"
*   },
* ),
*/
class Bike extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'make',
        'model',
        'year',
        'mods',
        'picture'
    ];

    /**
    * Relationship.
    *
    * @var string
    */
    public function builder()
    {
        return $this->belongsTo('App\Models\Builder');
    }

    /**
    * Relationship.
    *
    * @var string
    */
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }

    /**
     * Relationship
     *
     * @return void
     */
    public function garages()
    {
        return $this->belongsToMany('App\Models\Garage');
    }

    /**
     * Relationship
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relationship
     *
     * @return void
     */
    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }
}
