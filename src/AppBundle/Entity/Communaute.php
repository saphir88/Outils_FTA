<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * Communaute
 *
 * @ORM\Table(name="communaute")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommunauteRepository")
 * @UniqueEntity(
 *     fields="nomStartup",
 *     errorPath="nomStartup",
 *     message="Ce nom de startup est déjà utilisé !"
 * )
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable()
 *
 */
class Communaute
{
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomStartup", type="string", length=255)
     */
    private $nomStartup;

    /**
     * @var string
     *
     * @ORM\Column(name="nomSociete", type="string", length=255, nullable=true)
     */
    private $nomSociete;


    /**
     * @var string
     * @ORM\Column(name="filename", type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="filename")
     * @var File
     * @Assert\File(
     *     maxSize="2000k",
     *     mimeTypes = {"image/jpg", "image/png"},
     * )
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     *
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="ChaineYouTube", type="string", length=255, nullable=true)
     *
     */
    private $ChaineYouTube;



    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255, nullable=true)
     *
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="nomContact", type="string", length=255)
     *
     */
    private $nomContact;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     *
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     *
     * @Assert\Regex(
     *     pattern="/(0|\\+33|0033)[1-9][0-9]{8}/",
     *     match= true,
     *     message="Veuillez rentrer un numéro de telephone valide"
     * )
     */
    private $telephone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validation", type="smallint", nullable=true)
     */
    private $validation;


    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     *
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     *
     */
    private $twitter;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Participation", mappedBy="communaute", cascade={"persist","remove"})
     */
    private $participation;

    /**
     * @var string
     *
     * @ORM\Column(name="linkedin", type="string", length=255, nullable=true)
     *
     */
    private $linkedin;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Images", mappedBy="communaute", cascade="all", orphanRemoval=true, fetch="EAGER")
     * @Assert\All({
     *     @Assert\Type(type="AppBundle\Entity\Images"),
     * })
     * @Assert\Valid
     */
    private $images;



    /* Getters and Setters */
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNomStartup()
    {
        return $this->nomStartup;
    }

    /**
     * @param string $nomStartup
     */
    public function setNomStartup($nomStartup)
    {
        $this->nomStartup = $nomStartup;
    }

    /**
     * @return string
     */
    public function getNomSociete()
    {
        return $this->nomSociete;
    }

    /**
     * @param string $nomSociete
     */
    public function setNomSociete($nomSociete)
    {
        $this->nomSociete = $nomSociete;
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
        }

    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }
    /**
     * @return string
     */
    public function getChaineYouTube()
    {
        return $this->ChaineYouTube;
    }

    /**
     * @param string $ChaineYouTube
     */
    public function setChaineYouTube($ChaineYouTube)
    {
        $this->ChaineYouTube = $ChaineYouTube;
    }

    /**
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * @param string $siteWeb
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;
    }

    /**
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param string $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getNomContact()
    {
        return $this->nomContact;
    }

    /**
     * @param string $nomContact
     */
    public function setNomContact($nomContact)
    {
        $this->nomContact = $nomContact;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return bool
     */
    public function isValidation()
    {
        return $this->validation;
    }

    /**
     * @param bool $validation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @param string $linkedin
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file|null
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * @param mixed $participation
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;
    }

    /*---- Ajout des images via vichuploader -----*/

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add image
     *
     * @param Images $image
     *
     * @return Communaute
     */
    public function addImage(Images $image)
    {
        if ($image->getFile() == null ){
            return $this;
        }
        $this->images[] = $image;
        $image->setCommunaute($this);

        return $this;
    }

    /**
     * Remove image
     *
     * @param Images $image
     */
    public function removeImage(Images $image)
    {
        $path = "uploads/";
        $this->images->removeElement($image);
        unlink($path . $image->getFilename());
    }

//    /**
//     * @Assert\Callback
//     * @param ExecutionContextInterface $context
//     */
//    public function validate(ExecutionContextInterface $context)
//    {
//        // do your own validation
//        if (! in_array($this->file->getMimeType(), array(
//            'image/jpeg',
//            'image/png'
//        ))) {
//            $context
//                ->buildViolation('Erreur de format (Insérer uniquement une image au format jpg ou png)')
//                ->atPath('file')
//                ->addViolation();
//        }
//    }
//
//    /**
//     * @Assert\Callback
//     * @param ExecutionContextInterface $context
//     */
//    public function checkSize(ExecutionContextInterface $context)
//    {
//        // do your own validation
//        if ($this->file->getSize() > '500000') {
//            $context
//                ->buildViolation('Veuillez uploader un fichier inférieur à 5M.')
//                ->atPath('file')
//                ->addViolation();
//        }
//    }

}
