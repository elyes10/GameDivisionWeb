<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity
 */
class Teams
{
    /**
     * @var int
     *
     * @ORM\Column(name="team_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamId;

    /**
     * @var string
     *
     * @ORM\Column(name="team_name", type="string", length=255, nullable=false)
     */
    private $teamName;

    /**
     * @var string
     *
     * @ORM\Column(name="team_logo", type="string", length=255, nullable=false)
     */
    private $teamLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="Team_Website", type="string", length=255, nullable=false)
     */
    private $teamWebsite;

    /**
     * @var int
     *
     * @ORM\Column(name="user1_id", type="integer", nullable=false)
     */
    private $user1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="user2_id", type="integer", nullable=false)
     */
    private $user2Id;

    /**
     * @var int
     *
     * @ORM\Column(name="user3_id", type="integer", nullable=false)
     */
    private $user3Id;

    /**
     * @var int
     *
     * @ORM\Column(name="user4_id", type="integer", nullable=false)
     */
    private $user4Id;

    /**
     * @var int
     *
     * @ORM\Column(name="user5_id", type="integer", nullable=false)
     */
    private $user5Id;


}
