<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dialog;
use App\Http\Resources\Chat\Dialogs as DialogsCollection;

class DialogsController extends Controller
{
    public function getAll() {
        $dialogs = Dialog::me()->with('recipient')->get();
        return response()->json([
            'data' => DialogsCollection::collection($dialogs)
        ]);
    }

    public function getOne(Dialog $dialog) {        
        return response()->json([
            'data' => new DialogsCollection($dialog)
        ]);
    }
}
