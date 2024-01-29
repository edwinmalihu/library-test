<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Status;


class BookController extends Controller
{
    //
    public function AddBook(Request $request) {
        $validated = $request->validate([
            'book_name' => 'required',
            'id_category' => 'required|numeric',
            'id_status' => 'required|numeric'
        ]);

        Book::create($validated);
        return response()->json([
            "msg" => "Book Added"
        ], 201);
    }

    public function UpdateBook(Request $request, $id)
    {
        $validated = $request->validate([
            'book_name' => 'required',
            'id_category' => 'required|numeric',
            'id_status' => 'required|numeric'
        ]);

        Book::where('id_book', $id)->update($validated);
        return response()->json([
            "msg" => "Book Updated"
        ], 201);
    }

    public function GetBook($id)
    {
        $data = Book::find($id);

	    return response()->json([
	      'data' => $data
	    ], 201);
    }

    public function DeleteBook($id)
    {
        Book::destroy($id);
        return response()->json([
            'msg' => 'Book Deleted'
          ], 201);
    }

    public function ListBook() {
        $data = Book::join('category', 'category.id_category', '=', 'book.id_category')
        ->join('status', 'status.id_status', '=', 'book.id_status')
        ->get(['book.book_name', 'category.category_name', 'status.status_name']);

        return response()->json([
            "data" => $data
        ], 201);
    }



}
