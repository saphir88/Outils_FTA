<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 */
class Users
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
     * @ORM\Column(name="nomDeCompte", type="string", length=255, unique=true)
     */
    private $nomDeCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasse", type="string", length=32)
     */
    private $motDePasse;


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
     * Set nomDeCompte
     *
     * @param string $nomDeCompte
     *
     * @return Users
     */
    public function setNomDeCompte($nomDeCompte)
    {
        $this->nomDeCompte = $nomDeCompte;

        return $this;
    }

    /**
     * Get nomDeCompte
     *
     * @return string
     */
    public function getNomDeCompte()
    {
        return $this->nomDeCompte;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     *
     * @return Users
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }
}
