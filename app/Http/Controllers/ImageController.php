<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\CloudinaryStorage;
class ImageController extends Controller
{
    public function index()
    {
        return view('list_image', ['images' => Image::get()]);
    }

    public function create()
    {
        return view('upload_create');
    }

    public static function store($request, $product_id)
    {
        $images = $request;
        foreach ($images as $image) {
            $result = CloudinaryStorage::upload(
                $image->getRealPath(),
                $image->getClientOriginalName()
            );
            Image::create([
                'image' => $result,
                'product_id' => $product_id,
            ]);
        }
        return true;
    }

    public function show($id)
    {
        //
    }

    public function edit(Image $image)
    {
        return view('upload_update', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $file = $request->file('image');
        $result = CloudinaryStorage::replace(
            $image->image,
            $file->getRealPath(),
            $file->getClientOriginalName()
        );
        $image->update(['image' => $result]);
        return redirect()
            ->route('images.index')
            ->withSuccess('berhasil upload');
    }

    public function destroy(Image $image)
    {
        CloudinaryStorage::delete($image->image);
        $image->delete();
        return redirect()
            ->route('images.index')
            ->withSuccess('berhasil hapus');
    }
}
