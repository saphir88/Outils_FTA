<?php
namespace Upload\UploadBundle\Listener;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;
use Upload\UploadBundle\Annotation\UploadAnnotationReader;
use Upload\UploadBundle\Handler\UploadHandler;

class UploadSubscriber implements EventSubscriber {

    /**
     * @var UploadAnnotationReader
     */
    private $reader;

    /**
     * @var UploadHandler
     */
    private $handler;

    public function __construct(UploadAnnotationReader $reader, UploadHandler $handler)
    {
        $this->reader = $reader;
        $this->handler = $handler;
    }

    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
            'postLoad',
            'postRemove',
        ];
    }

    public function prePersist(EventArgs $event) {

        $this->preEvent($event);

    }

    public function preUpdate(EventArgs $event) {

        $this->preEvent($event);

    }

    private function preEvent(EventArgs $event) {
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->uploadFile($entity, $property, $annotation);
        }
    }

    public function postLoad(EventArgs $event) {

        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->setFileFromFilename($entity, $property, $annotation);
        }
    }

    public function postRemove(EventArgs $event) {

        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->removeFile($entity, $property);
        }
    }
}