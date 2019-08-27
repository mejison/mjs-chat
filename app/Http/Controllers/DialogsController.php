<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dialog;

class DialogsController extends Controller
{
    public function getAll() {
        $dialogs = Dialog::me()->with('recipient')->get();
        return response()->json([
            'data' => $dialogs
        ]);
    }
}
