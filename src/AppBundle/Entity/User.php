<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * User
 *
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_USER');
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Communaute",cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(onDelete="cascade")
     * @Assert\Valid  // On utilise Valid pour vérifier les erreur dans l'entité Communaute
     */
    private $communaute;


    /**
     * @Assert\Regex(
     *  pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/",
     *  message="Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre et un caractère spécial."
     * )
     */
    protected $plainPassword;

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
     * Set communaute.
     *
     * @param \AppBundle\Entity\Communaute|null $communaute
     *
     * @return User
     */
    public function setCommunaute(\AppBundle\Entity\Communaute $communaute = null)
    {
        $this->communaute = $communaute;

        return $this;
    }

    /**
     * Get communaute.
     *
     * @return \AppBundle\Entity\Communaute|null
     */
    public function getCommunaute()
    {
        return $this->communaute;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }
}
