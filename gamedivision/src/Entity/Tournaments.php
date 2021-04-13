<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournaments
 *
 * @ORM\Table(name="tournaments", indexes={@ORM\Index(name="Team_id", columns={"Team1_id"}), @ORM\Index(name="Game_id", columns={"Game_id"})})
 * @ORM\Entity
 */
class Tournaments
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
     * @ORM\Column(name="Tr_cover", type="string", length=255, nullable=false)
     */
    private $trCover;

    /**
     * @var int
     *
     * @ORM\Column(name="Game_id", type="integer", nullable=false)
     */
    private $gameId;

    /**
     * @var int
     *
     * @ORM\Column(name="Team1_id", type="integer", nullable=false)
     */
    private $team1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="Team2_id", type="integer", nullable=false)
     */
    private $team2Id;

    /**
     * @var int
     *
     * @ORM\Column(name="Team3_id", type="integer", nullable=false)
     */
    private $team3Id;

    /**
     * @var int
     *
     * @ORM\Column(name="Team4_id", type="integer", nullable=false)
     */
    private $team4Id;


}
