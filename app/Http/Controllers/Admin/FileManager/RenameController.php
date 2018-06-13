<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RenameController extends Controller
{
    /**
     * Rename the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rename(Request $request)
    {
        $path = $request->get('path', null);
        $oldName = $request->get('old_name', null);
        $newName = $request->get('new_name', null);
        $extension = $request->get('extension', null);

        if ($extension) {
            $oldName = $oldName . '.' . $extension;
            $newName = $newName . '.' . $extension;
        }

        if ($oldName && $newName && $oldName !== $newName) {
            Storage::disk('uploads')->move(
                $path . DIRECTORY_SEPARATOR . $oldName,
                $path . DIRECTORY_SEPARATOR . $newName
            );

            return redirect()
                ->back()
                ->with('success', trans('filemanager.rename.success'));
        }

        return redirect()->back();
    }
}
