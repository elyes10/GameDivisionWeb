<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favourites
 *
 * @ORM\Table(name="favourites")
 * @ORM\Entity
 */
class Favourites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="Product_id", type="integer", nullable=false)
     */
    private $productId;


}
