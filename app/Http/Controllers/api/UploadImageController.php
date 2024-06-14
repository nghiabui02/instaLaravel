<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $file = $request->file('image');

        $destinationPath = 'images';

        $customFileName = $file->getClientOriginalName();

        // Move the file to the desired destination with a custom name
        $filePath = $file->storeAs($destinationPath, $customFileName, 'local');
        $filename = $file->getClientOriginalName();


        return response()->json([
            'success' => true,
            'file_path' => $filePath,
            'filename' => $filename
        ]);

    }

    public function getFile(Request $request)
    {
        $filename = $request->filename;
        $filePath = 'images/' . $filename;

        if (!Storage::exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::get($filePath);
    }

    public function getAllImage(): JsonResponse
    {
        $directory = 'images/';
        $files = Storage::files($directory);
        $images = [];

        foreach ($files as $file) {
            $images[] = ('http://127.0.0.1:8000/api/').($file);
        }

        return response()->json([
            'success' => true,
            'image' => $images,
        ]);

    }

    public function view()
    {
        return view('Image.image');
    }
}
