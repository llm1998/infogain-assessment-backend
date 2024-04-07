<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreStoreRequest;
use App\Http\Requests\Store\UpdateStoreRequest;
use App\Models\Store;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Store::paginate(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $store = Store::create($request->all());
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([ 'message' => 'Ok', 'data' => $store ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return response()->json([ 'message' => 'Ok', 'data' => $store ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        DB::beginTransaction();

        try {
            $store->fill($request->all());
            $store->save();

            $store->refresh();

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([ 'message' => 'Ok', 'data' => $store ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        DB::beginTransaction();

        try {
            $storeClone = clone $store;
            $store = $store->delete();
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([ 'message' => 'Ok', 'data' => $storeClone, 'deleted' => $store ], Response::HTTP_OK);
    }
}
