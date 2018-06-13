<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Upload file in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->validateForm($request);

            $file = $request->file('file');
            $path = $request->get('path', null);

            Storage::disk('uploads')->putFileAs($path, $file, $file->getClientOriginalName());

            return redirect()
                ->back()
                ->with('success', trans('filemanager.upload.success'));
        }

        return redirect()
            ->back()
            ->with('error', trans('filemanager.upload.error'));
    }

    /**
     * Validate request form.
     *
     * @param Request $request
     */
    protected function validateForm(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:' . implode(',' , config('filemanager.mime_types'))
        ]);
    }
}
