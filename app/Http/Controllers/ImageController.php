<?php

namespace App\Http\Controllers;
use App\Models\Image\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function storeImage($file, $path = 'images')
    {
        $filename = $file->getClientOriginalName();
        $storedPath = Storage::disk('public')->putFile($path, $file);

        $image = new Image();
        $image->filename = $filename;
        $image->path = $storedPath;
        $image->save();

        return $image->id;
    }

    public function delete($id)
    {
        $image = Image::findOrFail($id);

        $path = ltrim($image->path, '/storage/');

        Storage::disk('public')->delete($path);

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }





}
