<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function show(Request $request)
    {
        // Vulnerabilidade: SQL Injection
        $id = $request->input('id');
        $user = DB::select("SELECT * FROM users WHERE id = $id"); // Sem Prepared Statements
        return response()->json($user);
    }
}
