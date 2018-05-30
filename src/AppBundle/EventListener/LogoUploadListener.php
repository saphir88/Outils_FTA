<?php
/**
 * Created by PhpStorm.
 * User: m0rsak
 * Date: 28/05/18
 * Time: 22:45
 */
namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Communautes;
use AppBundle\LogoUpload;

class LogoUploadListener
{
    private $uploader;

    public function __construct(LogoUpload $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        // Retrieve Form as Entity
        $entity = $args->getEntity();


        // Check which fields were changes
        $changes = $args->getEntityChangeSet();

        // Declare a variable that will contain the name of the previous file, if exists.
        $previousFilename = null;

        // Verify if the logo field was changed
        if(array_key_exists("logo", $changes)){
            // Update previous file name
            $previousFilename = $changes["logo"][0];
        }

        // If no new logo file was uploaded
        if(is_null($entity->getLogo())){
            // Let original filename in the entity
            $entity->setLogo($previousFilename);

            // If a new logo was uploaded in the form
        }else{
            // If some previous file exist
            if(!is_null($previousFilename)){
                $pathPreviousFile = $this->uploader->getTargetDir(). "/". $previousFilename;

                // Remove it
                if(file_exists($pathPreviousFile)){
                    unlink($pathPreviousFile);
                }
            }

            // Upload new file
            $this->uploadFile($entity);
        }
    }

    private function uploadFile($entity)
    {
        // upload only works for Communautes entities
        if (!$entity instanceof Communautes) {
            return;
        }

        $file = $entity->getLogo();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setLogo($fileName);
    }
}