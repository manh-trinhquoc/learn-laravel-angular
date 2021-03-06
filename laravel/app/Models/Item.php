<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* @OA\Schema(
    * schema="Item",
    * required={"type", "name", "company"},
    * @OA\Property(
        * property="type",
        * type="string",
        * description="Item Type",
        * example="Exhaust"
    * ),
    * @OA\Property(
        * property="name",
        * type="string",
        * description="Item name",
        * example="2 into 1 Exhaust"
    * ),
    * @OA\Property(
        * property="company",
        * type="string",
        * description="Produced by: some company",
        * example="Vance and Hines"
    * )
* )
*/
class Item extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'items';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'type',
        'name',
        'company',
        'bike_id'
    ];

    /**
    * Relationship.
    *
    * @var string
    */
    public function bike()
    {
        return $this->belongsTo('App\Models\Bike');
    }
}
