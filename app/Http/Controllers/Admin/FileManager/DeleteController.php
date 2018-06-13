<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $path = $request->get('path', null);
        $name = $request->get('name', null);
        $extension = $request->get('extension', null);

        if ($name) {
            $filePath = $path . '/' . $name;

            if ($extension) {
                Storage::disk('uploads')->delete($filePath . '.' . $extension);
            } else {
                Storage::disk('uploads')->deleteDirectory($filePath);
            }

            return redirect()
                ->back()
                ->with('success', trans('filemanager.delete.success'));
        }

        return redirect()
            ->back()
            ->with('error', trans('filemanager.delete.error'));
    }
}
