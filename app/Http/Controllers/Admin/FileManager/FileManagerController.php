<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class FileManagerController extends Controller
{
    protected $template = 'backend.filemanager.includes.filemanager';
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param DirectoryController $directory
     * @param FileController $file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, DirectoryController $directory, FileController $file)
    {
        $path = $request->get('path', null);
        $currentPage = $request->get('page', 1);
        $perPage = $request->get('per_page', 30);
        $modal = $request->get('modal', 0);
        $mime_types = $request->mime_types
            ? config('filemanager.' . $request->mime_types)
            : config('filemanager.mime_types');


        $collection = collect(array_merge($directory->all($path), $file->all($path, $mime_types)));

        $pagination = new LengthAwarePaginator(
            $collection->slice(($currentPage - 1) * $perPage, $perPage)->all(),
            $collection->count(),
            $perPage,
            LengthAwarePaginator::resolveCurrentPage(),
            [
                'path' => $request->url(),
                'query' => $request->query()
            ]
        );

        if (!$modal) {
            $this->template = 'backend.filemanager.index';
        }

        return view($this->template, [
            'items'          => $pagination,
            'isSubDirectory' => $path ? 1 : 0,
            'back'           => $this->backUrl($path),
            'modal'          => $modal
        ]);
    }

    public function backUrl($path)
    {
        $segments = explode('/', $path);

        array_pop($segments);

        return count($segments) > 0
            ? urldecode(route('admin.filemanager.index', ['path' => implode('/', $segments)]))
            : route('admin.filemanager.index');
    }
}
