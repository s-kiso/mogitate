<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function imageregister()
    {
        return view('image');
    }

    public function imagestore(Request $request)
    {
        $filename=$request->imgpath->getClientOriginalName();
        $img = $request->imgpath->storeAs('', $filename, 'public');
        return
        redirect('/img');
    }
}
