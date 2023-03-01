<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload()
    {  ///

        return view('upload');
    }
    public function store(Request $request)
    {
     // return $request->title;
        // $request->validate([
        //     'title' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        if ($request->hasFile('image')) {
            $extension  = request()->file('image')->getClientOriginalExtension(); //This is to get the extension of the image file just uploaded
            $image_name = time() . '_' . $request->title . '.' . $extension;
            $path = $request->file('image')->storeAs(
                'post_images_videos',
                $image_name,
                's3'
            );
         //   return Storage::url($path);
            //  return $path;
            // Image::create([
            //     'title' => $request->title,
            //     'image' => $path
            // ]);
            return redirect()->back()->with([
                'message' => "Image uploaded successfully",
            ]);
        }
    }
}
