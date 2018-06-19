<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Upload\UploadBundle\Annotation\Uploadable;
use Upload\UploadBundle\Annotation\UploadableField;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImagesRepository")
 * @Uploadable()
 */
class Images
{
    /**
     * @var Communaute
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Communaute", inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     */
    private $communaute;

    public function __construct(Communaute $communaute = null)
    {
        $this->communaute = $communaute;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="filename", type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @UploadableField(filename="filename", path="uploads")
     */
    private $file;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getCommunaute()
    {
        return $this->communaute;
    }

    /**
     * @param mixed $communaute
     */
    public function setCommunaute($communaute)
    {
        $this->communaute = $communaute;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }


    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


}
