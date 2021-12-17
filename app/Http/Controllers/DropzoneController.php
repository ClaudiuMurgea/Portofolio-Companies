<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Banner;
use App\Models\Media;


class DropzoneController extends Controller
{
    function index ()
    {
        return view('dropzone');
    }
    function upload (Request $request, $id)
    {   
        $image = $request->file('file');

        $imageName = 'photos/' . time() . '.' . $image->extension();
        $image->move(public_path('storage/photos'), $imageName);
        $image->save();

        $media = new Media();
        $media->url = $imageName;
        $media->save();

        $banner = new Banner();
        $banner->company_id = $id;
        $banner->media_id = $media->id;
        $banner->name = $imageName;
        $banner->save();

        return response()->json(['success' => $imageName]);
    }

}
