<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Book::paginate(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        DB::beginTransaction();

        try {
            $book = Book::create($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([ 'message' => 'Ok', 'data' => $book ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json([ 'message' => 'Ok', 'data' => $book ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        DB::beginTransaction();

        try {
            $book->fill($request->all());
            $book->value = floatval($request->value);
            $book->update();

            $book->refresh();
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([ 'message' => 'Ok', 'data' => $book ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        DB::beginTransaction();

        try {
            $bookClone = clone $book;
            $book = $book->delete();
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json([ 'message' => $e->getMessage() ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'Ok', 'data' => $bookClone, 'deleted' => $book ], Response::HTTP_OK);
    }
}
