<?php
/**
 * Created by PhpStorm.
 * User: m0rsak
 * Date: 10/06/18
 * Time: 16:03
 */
namespace Upload\UploadBundle\Annotation;

use Doctrine\Common\Annotations\AnnotationReader;

class UploadAnnotationReader {

    /**
     * @var AnnotationReader
     */
    private $reader;

    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Liste les champs uploadable d'une entité (sous forme de tableau associatif)
     */
    public function getUploadableFields($entity): array {
        $reflection = new \ReflectionClass(get_class($entity));
        $properties = [];
        foreach($reflection->getProperties() as $property) {
            $annotation = $this->reader->getPropertyAnnotation($property, UploadableField::class);
            if ($annotation !== null) {
                $properties[$property->getName()] = $annotation;
            }
        }
        return $properties;
    }
}