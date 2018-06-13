<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CreateController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);

        Storage::disk('uploads')->makeDirectory($request->path . '/' . $request->name);

        return redirect()
            ->back()
            ->with('success', trans('filemanager.directory.create'));
    }

    /**
     * Validate request form.
     *
     * @param Request $request
     */
    protected function validateForm(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|alpha_dash'
        ]);
    }
}
