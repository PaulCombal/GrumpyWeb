<?php

namespace EX\GrumpyBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1D1C63B392FC23A8", columns={"username_canonical"}), @ORM\UniqueConstraint(name="UNIQ_1D1C63B3A0D96FBF", columns={"email_canonical"}), @ORM\UniqueConstraint(name="UNIQ_1D1C63B3C05FB297", columns={"confirmation_token"})})
 * @ORM\Entity
 */
class Utilisateur extends BaseUser
{

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = array('ROLE_USER');
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    protected $first_name;


    /**
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    protected $last_name;

    /**
     * @ORM\ManyToMany(targetEntity="EX\GrumpyBundle\Entity\Groupe")
     * @ORM\JoinTable(name="user_groupe",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;



    /**
     * Set firstName
     *
     * @param \varchar $firstName
     *
     * @return Utilisateur
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return \varchar
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param \varchar $lastName
     *
     * @return Utilisateur
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return \varchar
     */
    public function getLastName()
    {
        return $this->last_name;
    }
}
