<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\EmptyOrderProducts;
use App\Http\Controllers\Controller;
use App\Lib\Orders\OrderManager;
use http\Client\Curl\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status' => true]);
    }

    /**
     * Создание нового заказа.
     *
     * @param    Request    $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $json = $request->json()->all();

        return response()->json(
            [
                'data' => OrderManager::create($json)
            ]
        );
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
