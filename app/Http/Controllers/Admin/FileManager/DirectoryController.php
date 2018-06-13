<?php

namespace App\Http\Controllers\Admin\FileManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DirectoryController extends Controller
{
    /**
     * Return directory list.
     *
     * @param $path
     * @return array
     */
    public function all($path)
    {
        return array_map(function ($path) {
                return collect([
                    'name'        => $this->getName($path),
                    'url'         => urldecode($this->getPath($path)),
                    'type'        => __('Папка'),
                    'image'       => $this->getIcon(),
                    'isDirectory' => true,
                ]);
            },
            Storage::disk('uploads')->directories($path)
        );
    }

    /**
     * Return directory name.
     *
     * @param $path
     * @return mixed
     */
    protected function getName($path)
    {
        $segments = $this->segments($path);

        return count($segments) > 0 ? end($segments) : '';
    }

    /**
     * Return directory path.
     *
     * @param $directory
     * @return string
     */
    protected function getPath($path)
    {
        return route('admin.filemanager.index', ['path' => $path]);
    }

    /**
     * Return directory icon.
     *
     * @return string
     */
    protected function getIcon()
    {
        return asset(config('filemanager.default.directory'));
    }

    /**
     * Return path segments.
     *
     * @param $path
     * @return array
     */
    protected function segments($path)
    {
        return explode('/', $path);
    }
}
