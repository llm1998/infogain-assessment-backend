<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\Book\StoreStoreBookRequest;
use App\Http\Requests\Store\Book\UpdateStoreBookRequest;
use App\Models\Store;
use App\Models\StoreBook;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StoreBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Store $store)
    {
        return response()->json([ 'message' => 'Ok', 'data' => $store->with('book')->paginate() ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreBookRequest $request, Store $store)
    {
        DB::beginTransaction();

        try {
            $storeBook = StoreBook::create([
                'store_id' => $store->id,
                'book_id' => $request->book_id
            ]);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([ 'message' => 'Ok', 'data' => $storeBook ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store, StoreBook $storeBook)
    {
        return response()->json([ 'message' => 'Ok', 'data' => $storeBook ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreBookRequest $request, Store $store, StoreBook $storeBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store, StoreBook $storeBook)
    {
        //
    }
}
