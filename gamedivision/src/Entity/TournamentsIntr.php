<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TournamentsIntr
 *
 * @ORM\Table(name="tournaments_intr")
 * @ORM\Entity
 */
class TournamentsIntr
{
    /**
     * @var int
     *
     * @ORM\Column(name="Tr_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $trId;

    /**
     * @var string
     *
     * @ORM\Column(name="tr_cover", type="string", length=255, nullable=false)
     */
    private $trCover;

    /**
     * @var string
     *
     * @ORM\Column(name="tr_link", type="string", length=255, nullable=false)
     */
    private $trLink;


}
