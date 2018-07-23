<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImagesRepository")
 * @Vich\Uploadable()
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
     * @Vich\UploadableField(mapping="images", fileNameProperty="filename")
     *
     * @var File
     * @Assert\File(
     *     maxSize="2000k",
     *     mimeTypes = {"image/jpg", "image/png"},
     *     uploadIniSizeErrorMessage="{{ limit }}"
     * )
     */
    private $file;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime
     */
    private $updatedAt;


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
        if ($filename !== null){
            $this->filename = $filename;
            if ($filename instanceof File) {
                $this->setUpdatedAt(new \DateTime());
            }
        }

    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    public function setFile(File $image = null)
    {
        $this->file = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }



}
