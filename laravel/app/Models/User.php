<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
* @OA\Schema(
    * schema="User",
    * required={"name", "email", "password"},
    * @OA\Property(
        * property="name",
        * type="string",
        * description="User name",
        * example="John Conor"
    * ),
    * @OA\Property(
        * property="email",
        * type="string",
        * description="Email Address",
        * example="john.conor@terminator.com"
    * ),
    * @OA\Property(
        * property="password",
        * type="string",
        * description="A very secure password",
        * example="123456"
    * ),
* )
*/
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
