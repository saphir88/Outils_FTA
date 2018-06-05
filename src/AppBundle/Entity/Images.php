<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Communaute")
     * @ORM\JoinColumn(nullable=false)
     */
    private $communaute;

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
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Images
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set communaute
     *
     * @param \AppBundle\Entity\Communautes $communaute
     *
     * @return Images
     */
    public function setCommunaute(\AppBundle\Entity\Communautes $communaute)
    {
        $this->communaute = $communaute;

        return $this;
    }

    /**
     * Get communaute
     *
     * @return \AppBundle\Entity\Communautes
     */
    public function getCommunaute()
    {
        return $this->communaute;
    }
}
