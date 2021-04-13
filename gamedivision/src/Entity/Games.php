<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Games
 *
 * @ORM\Table(name="games")
 * @ORM\Entity
 */
class Games
{
    /**
     * @var int
     *
     * @ORM\Column(name="Game_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gameId;

    /**
     * @var string
     *
     * @ORM\Column(name="Game_name", type="string", length=255, nullable=false)
     */
    private $gameName;

    /**
     * @var string
     *
     * @ORM\Column(name="Game_cover", type="string", length=255, nullable=false)
     */
    private $gameCover;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;


}
