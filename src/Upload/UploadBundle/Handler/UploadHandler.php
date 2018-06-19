<?php
namespace Upload\UploadBundle\Handler;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PropertyAccess\PropertyAccess;

class UploadHandler {

    private $accessor;

    public function __construct() {
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    public function uploadFile($entity, $property, $annotation) {
        $file = $this->accessor->getValue($entity, $property);
        if ($file instanceof UploadedFile) {
            $this->removeOldFile($entity, $annotation);
            $extension = $file->getClientOriginalExtension();
            $filename = md5(uniqid($extension)) . "." . $extension;
            $file->move($annotation->getPath(), $filename);
            $this->accessor->setValue($entity, $annotation->getFilename(), $filename);
        }
    }

    public function setFileFromFilename($entity, $property, $annotation)
    {
        $file = $this->getFileFromFilename($entity, $annotation);
        $this->accessor->setValue($entity, $property, $file);
    }

    public function removeOldFile($entity, $annotation)
    {
        $file = $this->getFileFromFilename($entity, $annotation);
        if ($file !== null) {
            @unlink($file);
        }
    }

    public function removeFile($entity, $property)
    {
        $file = $this->accessor->getValue($entity, $property);
        if ($file instanceof File) {
            @unlink($file->getRealPath());
        }
    }

    private function getFileFromFilename ($entity, $annotation) {

        $filename = $this->accessor->getValue($entity, $annotation->getFilename());
        if (empty($filename)) {
            return null;
        } else {


            return $annotation->getPath() . DIRECTORY_SEPARATOR . $filename;
        }
    }

}