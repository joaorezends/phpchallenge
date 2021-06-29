<?php

use App\Presentation\Api\Http\PeopleController;
use App\Presentation\Api\Http\ShipordersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="PHP Challenge API",
 *      @OA\Contact(
 *          name="joaorezends",
 *          url="https://github.com/joaorezends"
 *      )
 * )
 */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * @OA\Get(
 *      path="/api/people",
 *      tags={"People"},
 *      summary="Get list of people",
 *      description="Returns list of people",
 *      @OA\Response(response=200, description="Successful Operation"),
 *      @OA\Response(response=400, description="Bad Request")
 * )
 *
 * Returns list of people
 */

/**
 * @OA\Get(
 *      path="/api/people/{id}",
 *      tags={"People"},
 *      summary="Get a person",
 *      description="Returns a person",
 *      @OA\Parameter(
 *          name="id",
 *          description="Person id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(response=200, description="Successful Operation"),
 *      @OA\Response(response=400, description="Bad Request"),
 *      @OA\Response(response=404, description="Resource Not Found")
 * )
 *
 * Returns a person
 */
Route::apiResource("people", PeopleController::class)->only("index", "show");

/**
 * @OA\Get(
 *      path="/api/shiporders",
 *      tags={"Shiporder"},
 *      summary="Get list of shiporders",
 *      description="Returns list of shiporders",
 *      @OA\Response(response=200, description="Successful Operation"),
 *      @OA\Response(response=400, description="Bad Request")
 * )
 *
 * Returns list of shiporders
 */

/**
 * @OA\Get(
 *      path="/api/shiporders/{id}",
 *      tags={"Shiporder"},
 *      summary="Get a shiporder",
 *      description="Returns a shiporder",
 *      @OA\Parameter(
 *          name="id",
 *          description="Shiporder id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(response=200, description="Successful Operation"),
 *      @OA\Response(response=400, description="Bad Request"),
 *      @OA\Response(response=404, description="Resource Not Found")
 * )
 *
 * Returns a shiporder
 */
Route::apiResource("shiporders", ShipordersController::class)->only("index", "show");
