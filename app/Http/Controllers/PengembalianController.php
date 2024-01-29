<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Book;

class PengembalianController extends Controller
{
    //
    public function PengembalianBook(Request $request)  {
        $validated = $request->validate([
            'kode_peminjaman' => 'required',
            'id_status' => 'required',
        ]);

        $kode = $request->input('kode_peminjaman');
        $id_status = $request->input('id_status');

        Pengembalian::create($validated);
        $id_book = Peminjaman::where('kode_peminjaman', $kode)->get();

        foreach ($id_book as $b) {
            $id = $b->id_book;
            Book::where('id_book', $id)->update(['id_status' => $id_status]);
        }

        Peminjaman::where('kode_peminjaman', $kode)->delete();

    

        return response()->json([
            "msg" => "the book was successfully returned",
        ], 201);

    }

    public function ListPengembalian()  {

        $data = Pengembalian::All();

        return response()->json([
            "data" => $data
        ], 200);

    }

    public function GetPengembalian($id)  {
        $data = Pengembalian::find($id);

        return response()->json([
            "data" => $data
        ], 200);

    }

    


}
