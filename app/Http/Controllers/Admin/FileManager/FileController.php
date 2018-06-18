<?php

namespace App\Http\Controllers\Admin\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    /**
     * Return file list.
     *
     * @param $path
     * @return array
     */
    public function all($path, $mime_types)
    {
        $results = array_map(
            function ($file) use ($path, $mime_types) {
                $extension = $this->getExtension($file);

                if (in_array($extension, $mime_types)) {
                    return collect([
                        'url'       => $this->getUrl($file),
                        'name'      => $this->getName($file),
                        'extension' => $extension,
                        'type'      => $this->getType($extension),
                        'image'     => $this->isImage($extension)
                            ? $this->getImagePath($file)
                            : $this->getIcon($extension)
                    ]);
                }
            },
            Storage::disk('uploads')->files($path)
        );

        return array_filter($results);
    }

    /**
     * Return file url.
     *
     * @param $file
     * @return mixed
     */
    protected function getUrl($file)
    {
        return asset(config('filemanager.directory') . DIRECTORY_SEPARATOR . $file);
    }

    /**
     * Return file name.
     *
     * @param $file
     * @return mixed
     */
    protected function getName($file)
    {
        $segments = $this->segments($file);

        return substr(strstr(end($segments),'.', true),0) ? : null;
    }

    /**
     * Return file extension.
     *
     * @param $file
     * @return bool|string
     */
    protected function getExtension($file)
    {
        return substr(strstr($file,'.'),1);
    }

    /**
     * Return file type.
     *
     * @param $extension
     * @return mixed|string
     */
    protected function getType($extension)
    {
        return array_key_exists($extension, config('filemanager.types'))
            ? config('filemanager.types')[$extension]
            : 'Unknown';
    }

    protected function isImage($extension) : bool
    {
        return in_array($extension, config('filemanager.image'));
    }

    /**
     * Return image source.
     *
     * @param $file
     * @return mixed
     */
    protected function getImagePath($file)
    {
        $image = Image::make(config('filemanager.directory') . DIRECTORY_SEPARATOR . $file);

        $image->fit(
            config('filemanager.thumb.width'),
            config('filemanager.thumb.height')
        );

        return $image->encode('data-url');
    }

    /**
     * Return file icon.
     *
     * @param $extension
     * @return string
     */
    protected function getIcon($extension)
    {
        return array_key_exists($extension, config('filemanager.icons'))
            ? asset(config('filemanager.icons')[$extension])
            : asset(config('filemanager.default.file'));
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
