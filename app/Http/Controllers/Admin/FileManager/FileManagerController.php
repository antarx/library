<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class FileManagerController extends Controller
{
    protected $perPage = 30;

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

        $collection = collect(array_merge($directory->all($path), $file->all($path)));

        $pagination = new LengthAwarePaginator(
            $collection->slice(($currentPage - 1) * $this->perPage, $this->perPage)->all(),
            $collection->count(),
            $this->perPage,
            LengthAwarePaginator::resolveCurrentPage(),
            [
                'path' => $request->url(),
                'query' => $request->query()
            ]
        );

        return view('backend.filemanager.index', [
            'items'          => $pagination,
            'isSubDirectory' => $path ? 1 : 0,
            'back'           => $this->backUrl($path)
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
