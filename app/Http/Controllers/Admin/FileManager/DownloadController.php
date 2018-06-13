<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        $path = $request->get('path', null);
        $name = $request->get('name', null);
        $extension = $request->get('extension', null);

        if ($name && $extension) {
            $filePath = $path . '/' . $name . '.' . $extension;

            return Storage::disk('uploads')->download($filePath);
        }
    }
}
