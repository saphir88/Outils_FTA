<?php

namespace AppBundle\Repository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends \Doctrine\ORM\EntityRepository
{
    public function findLastEvent()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT ev FROM AppBundle:Event AS ev WHERE ev.id = (SELECT MAX(ada.id) FROM AppBundle:Event ada)")
            ->getResult();
    }

    public function findAllEventPast()
    {
        return $this->findBy(array(), array('date' => 'DESC'));
    }

    public function findAllEventToCome()
    {
        return $this->findBy(array(), array('date' => 'DESC'));
    }


}
