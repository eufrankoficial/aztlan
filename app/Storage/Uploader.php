<?php

namespace App\Storage;

use App\Interfaces\UploaderInterface;

class Uploader implements UploaderInterface
{
    use GettersSetters;

    protected $file;
    protected $fileName;
    protected $path;
    protected $fileType;
    protected $driver = 's3';
    protected $types = [
        'png',
        'jpeg',
        'jpg',
    ];

    public function validateFile()
    {
        $extension = $this->getFileType();
        if (!in_array($extension, $this->types)) {
            throw new \Exception('Arquivo não permitido', 1);

            return false;
        }

        return true;
    }

    public function upload($file, $path)
    {
        $this->setPath($path);
        $this->setFile($file);
        $this->setFileType($file->extension());
        $this->validateFile();
        $this->setFileNameToS3();

        return $this->getFile()->storeAs(
            $this->getPath(),
            $this->getFileNameToS3(),
            $this->driver
        );
    }
}
