<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var string
     *
     * @ORM\Column(name="order_id", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderId;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adr_livraison", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $adrLivraison = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $country = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="post_code", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $postCode = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $date = 'NULL';

    /**
     * @var float|null
     *
     * @ORM\Column(name="total_price", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $totalPrice = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=false, options={"default"="'''preparation'''"})
     */
    private $status = '\'\'\'preparation\'\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="liste_produit", type="string", length=3000, nullable=false)
     */
    private $listeProduit;


}
