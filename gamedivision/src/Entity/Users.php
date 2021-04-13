<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="User_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="User_name", type="string", length=30, nullable=false)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="User_lastname", type="string", length=30, nullable=false)
     */
    private $userLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="User_Email", type="string", length=100, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="User_phone", type="string", length=60, nullable=false)
     */
    private $userPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="User_password", type="string", length=30, nullable=false)
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="User_photo", type="string", length=100, nullable=false)
     */
    private $userPhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="User_gender", type="string", length=6, nullable=false)
     */
    private $userGender;

    /**
     * @var int
     *
     * @ORM\Column(name="user_role", type="integer", nullable=false, options={"default"="1"})
     */
    private $userRole = 1;


}
