<?php

namespace App\Storage;

trait GettersSetters
{
    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setFileType($type)
    {
        $this->fileType = $type;
    }

    public function getFileType()
    {
        return $this->fileType;
    }

    public function setFileNameToS3()
    {
        $name = $this->getFileName();
        $name = strtolower($name);
        $name = str_replace(' ', '-', $name);
        $arrayNameWithExtension = explode('.', $name);
        $nameWithoutExtension = $arrayNameWithExtension[0];
        $extension = $arrayNameWithExtension[1];
        $this->fileName = $nameWithoutExtension.'-'.now()->format('Y-m-d').'.'.$extension;
    }

    public function getFileNameToS3()
    {
        return $this->fileName;
    }

    public function getFileName()
    {
        return $this->getFile()->getClientOriginalName();
    }
}
