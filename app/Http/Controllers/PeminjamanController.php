<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Support\Carbon;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    //
    public function PinjamBuku(Request $request)  {
        $validated = $request->validate([
            'id_book' => 'required|array',
            'id_book.*' => 'exists:book,id_book',
            'id_status' => 'required|numeric'
        ]);
    

        $id_book = $request->input('id_book');
        $id_status = $request->input('id_status');
        $currentDateTime = Carbon::now();
        $desk_pinjam = "PINJ";
        $formattedDate = $currentDateTime->format('YmdHis');
        $kode_peminjaman = $desk_pinjam . $formattedDate;

        

        foreach ($id_book as $id_books) {

            $data = Book::find($id_books);
            
            if ($data->id_status == 2) {
                return response()->json([
                    "msg" => 'the book has been borrowed'
                ], 201);
            }

            Peminjaman::create([
                'id_book' => $id_books,
                'kode_peminjaman' => $kode_peminjaman
            ]);

            Book::where('id_book', $id_books)->update(['id_status' => $id_status]);
        }
        

        return response()->json([
            "msg" => 'book successfully borrowed'
        ], 201);



    }

    public function ListPeminjamanBook() {
        $data = Book::join('peminjaman', 'peminjaman.id_book', '=', 'book.id_book')
        ->join('status', 'status.id_status', '=', 'book.id_status')
        ->join('category', 'category.id_category', '=', 'book.id_category')
        ->get(['book.book_name','peminjaman.kode_peminjaman', 'status.status_name', 'category.category_name']);

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function GetPeminjaman($kode)  {
        $data = Peminjaman::where('kode_peminjaman', $kode)->get();

        return response()->json([
            "data" => $data
        ], 200);

    }
}
