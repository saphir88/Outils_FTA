<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParticipationRepository")
 */
class Participation
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
     * @var int
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Communaute", inversedBy="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $communaute;

    /**
     * @var int
     * @ORM\Column(name="nb_vote", type="integer", options={"default" : 0})
     */
    private $nbVote;

    /**
     * @return int
     */
    public function getNbVote()
    {
        return $this->nbVote;
    }

    /**
     * @param int $nbVote
     */
    public function setNbVote($nbVote)
    {
        $this->nbVote = $nbVote;
    }

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
     * @return int
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param int $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return int
     */
    public function getCommunaute()
    {
        return $this->communaute;
    }

    /**
     * @param int $communaute
     */
    public function setCommunaute($communaute)
    {
        $this->communaute = $communaute;
    }
}
