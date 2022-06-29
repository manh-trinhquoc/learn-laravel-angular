<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    /**
    * Register a new user.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    *
    * @OA\Post(
        * path="/api/register",
        * tags={"Users"},
        * summary="Create new User",
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/components/schemas/User"),
 *          )
 *      ),
        * @OA\Response(
            * response=201,
            * description="Success: A Newly Created User",
            * @OA\Schema(ref="#/definitions/User")
        * ),
        * @OA\Response(
            * response=200,
            * description="Success: operation Successfully"
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
        * )
    * ),
    */
    public function register(Request $request)
    {
        //TODO: tìm hiểu thêm về validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        //TODO: tìm hiểu thêm về auth: https://laravel.com/docs/9.x/authentication
        $token = auth()->guard('api')->login($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], 201);
    }

    /**
    * Log in a user.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    *
    * @OA\Post(
        * path="/api/login",
        * tags={"Users"},
        * summary="loggin an user",
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/components/schemas/User"),
 *          )
 *      ),
        * @OA\Response(
            * response=200,
            * description="Success: operation Successfully"
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
        * )
    * ),
    */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 400);
        }
        $current_user = $request->email;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'current_user' => $current_user,
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ], 200);
    }

    /**
    * Register a new user.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    *
    * @OA\Post(
        * path="/api/logout",
        * tags={"Users"},
        * summary="logout an user",
        * @OA\RequestBody(
    *       @OA\JsonContent(
        *       @OA\Schema(ref="#/components/schemas/User"),
 *          )
 *      ),
        * @OA\Response(
            * response=200,
            * description="Success: operation Successfully"
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
            * description="Invalid input"
        * ),
        * security={
            * { "api_key":{} }
        * }
    * ),
    */
    public function logout(Request $request)
    {
        auth()->logout(true); // Force token to blacklist

        return response()->json(['success' => 'Logged out    Successfully.'], 200);
    }
}
