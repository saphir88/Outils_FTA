<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * User
 *
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class User extends BaseUser
{

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Communaute",cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="cascade")
     */
    private $communaute;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
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
}
