<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Band",
 *     description="cac ban nhac",
 *     schema="Band",
 *     required={"name", "description"},
    * @OA\Property(
        * property="name",
        * type="string",
        * description="band name",
        * example="tesst"
    * ),
    * @OA\Property(
        * property="description",
        * type="string",
        * description="mo ta",
        * example="tesst mota"
    * ),
 * )
 */
class Band extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];
}
