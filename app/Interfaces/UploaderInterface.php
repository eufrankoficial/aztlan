<?php

namespace App\Interfaces;

interface UploaderInterface
{
    public function setFile($file);

    public function setPath($path);

    public function setFileType($type);

    public function upload($file, $path);
}
