<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\MyNote;

class MyNotesController extends Controller
{
    public function index($id)
    {
        $myNotes = MyNote::all()->where( 'user_id', $id );
        return response()->json($myNotes);
    }

    public function store(Request $request)
    {
        $myNote = MyNote::create(
            [
                'title' => $request->title,
                'body' => $request->body,
                'is_public' => $request->is_public,
                'user_id' => $request->user_id,
            ]
        );
        // var_dump(auth('sanctum')->user()); die;
        return response()->json([$myNote]);
    }

    public function show($id)
    {
        $myNote = MyNote::find($id);
        if(!$myNote) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($myNote);
    }

    public function update(Request $request, $id)
    {
        $myNote = MyNote::find($id);
        $myNote->update(
            [
                'title' => $request->title,
                'body' => $request->body,
                // 'is_public' => $request->is_public,
                // 'user_id' => auth('sanctum')->user()->id,
            ]
        );
        return response()->json($myNote);
    }

    public function destroy($id)
    {
        $myNote = MyNote::find($id);
        $myNote->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
