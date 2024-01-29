<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    //
    public function AddStatus(Request $request) {
        $validated = $request->validate([
            'status_name' => 'required'
        ]);

        Status::create($validated);
        return response()->json([
            "msg" => "Status Added"
        ], 201);
    }
}
