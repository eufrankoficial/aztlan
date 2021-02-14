<?php

namespace App\Storage;

class ImageUploader extends Uploader
{
    public function makeUpload($file, $path)
    {
        return $this->upload($file, $path);
    }
}
