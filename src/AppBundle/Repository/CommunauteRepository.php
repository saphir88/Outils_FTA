<?php

namespace AppBundle\Repository;

/**
 * CommunauteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

use Doctrine\ORM\EntityRepository;

class CommunauteRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllValidTrue()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT c FROM AppBundle:Communaute c WHERE c.validation='1'")
            ->getResult();
    }

    public function findAllValidFalse()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT c FROM AppBundle:Communaute c WHERE c.validation='0'")
            ->getResult();
    }

    public function findAllByCategory($categorie)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT c FROM AppBundle:Communaute c WHERE c.categorie='$categorie'")
            ->getResult();
    }

    public function delete($id)
    {
        return $this->getEntityManager()
            ->createQuery("DELETE FROM AppBundle:Communaute c WHERE c.id=$id")
            ->getResult();
    }

    public function validate($id)
    {
        return $this->getEntityManager()
            ->createQuery("UPDATE AppBundle:Communaute c SET c.validation='1' WHERE c.id=$id")
            ->getResult();
    }

    public function findCompteById($id)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT c FROM AppBundle:Communaute c WHERE c.id = $id")
            ->getResult();


    }public function findUserById()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT u.username,c FROM AppBundle:User u with AppBudle:communaute c WHERE u.id = 33")
            ->getResult();

    }
}


