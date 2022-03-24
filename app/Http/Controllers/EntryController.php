<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function entry($request){
        return response()->json(['message' => '']);
    }
}
