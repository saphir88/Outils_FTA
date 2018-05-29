<?php
/**
 * Created by PhpStorm.
 * User: m0rsak
 * Date: 28/05/18
 * Time: 22:39
 */

namespace AppBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class LogoUpload
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}