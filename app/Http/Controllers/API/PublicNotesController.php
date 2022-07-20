<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\MyNote;

class PublicNotesController extends Controller
{
    public function index()
    {
        $myNotes = MyNote::all()->sortByDesc('id');
        return response()->json($myNotes);
    }

    public function show($id)
    {
        $myNote = MyNote::find($id);
        if(!$myNote) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($myNote);
    }
}
