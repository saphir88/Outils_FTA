<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StartUps
 *
 * @ORM\Table(name="start_ups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StartUpsRepository")
 */
class StartUps
{
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
     * @ORM\Column(name="Label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Tags", type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="SIRET", type="string", length=255, nullable=true)
     */
    private $sIRET;

    /**
     * @var string
     *
     * @ORM\Column(name="SiteInternet", type="string", length=255, nullable=true)
     */
    private $siteInternet;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="AnneeCreation", type="string", length=255, nullable=true)
     */
    private $anneeCreation;


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
     * Set label
     *
     * @param string $label
     *
     * @return StartUps
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return StartUps
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return StartUps
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return StartUps
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return StartUps
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set sIRET
     *
     * @param string $sIRET
     *
     * @return StartUps
     */
    public function setSIRET($sIRET)
    {
        $this->sIRET = $sIRET;

        return $this;
    }

    /**
     * Get sIRET
     *
     * @return string
     */
    public function getSIRET()
    {
        return $this->sIRET;
    }

    /**
     * Set siteInternet
     *
     * @param string $siteInternet
     *
     * @return StartUps
     */
    public function setSiteInternet($siteInternet)
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    /**
     * Get siteInternet
     *
     * @return string
     */
    public function getSiteInternet()
    {
        return $this->siteInternet;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return StartUps
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set anneeCreation
     *
     * @param string $anneeCreation
     *
     * @return StartUps
     */
    public function setAnneeCreation($anneeCreation)
    {
        $this->anneeCreation = $anneeCreation;

        return $this;
    }

    /**
     * Get anneeCreation
     *
     * @return string
     */
    public function getAnneeCreation()
    {
        return $this->anneeCreation;
    }
}

