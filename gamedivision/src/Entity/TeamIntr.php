<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamIntr
 *
 * @ORM\Table(name="team_intr")
 * @ORM\Entity
 */
class TeamIntr
{
    /**
     * @var int
     *
     * @ORM\Column(name="team_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teamId = '0';

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
     * @ORM\Column(name="member1_id", type="integer", nullable=false)
     */
    private $member1Id;

    /**
     * @var int
     *
     * @ORM\Column(name="member2_id", type="integer", nullable=false)
     */
    private $member2Id;

    /**
     * @var int
     *
     * @ORM\Column(name="member3_id", type="integer", nullable=false)
     */
    private $member3Id;

    /**
     * @var int
     *
     * @ORM\Column(name="member4_id", type="integer", nullable=false)
     */
    private $member4Id;

    /**
     * @var int
     *
     * @ORM\Column(name="member5_id", type="integer", nullable=false)
     */
    private $member5Id;


}
