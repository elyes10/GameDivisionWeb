<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="User_id", columns={"User_id"})})
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @var string
     *
     * @ORM\Column(name="User_id", type="string", length=50, nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="Subject", type="text", length=65535, nullable=false)
     */
    private $subject;

    /**
     * @var int
     *
     * @ORM\Column(name="Reclamation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reclamationId;

    /**
     * @var string
     *
     * @ORM\Column(name="Reclamation_context", type="text", length=65535, nullable=false)
     */
    private $reclamationContext;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;


}
