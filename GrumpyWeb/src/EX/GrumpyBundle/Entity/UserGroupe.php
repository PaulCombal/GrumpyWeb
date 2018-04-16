<?php

namespace EX\GrumpyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroupe
 *
 * @ORM\Table(name="user_groupe", indexes={@ORM\Index(name="FK_user_groupe_id_groupe", columns={"id_groupe"}), @ORM\Index(name="FK_user_groupe_id_utilisateur", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class UserGroupe
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
     * @var \Groupe
     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_groupe", referencedColumnName="id")
     * })
     */
    private $idGroupe;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     * })
     */
    private $idUtilisateur;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idGroupe.
     *
     * @param \EX\GrumpyBundle\Entity\Groupe|null $idGroupe
     *
     * @return UserGroupe
     */
    public function setIdGroupe(\EX\GrumpyBundle\Entity\Groupe $idGroupe = null)
    {
        $this->idGroupe = $idGroupe;

        return $this;
    }

    /**
     * Get idGroupe.
     *
     * @return \EX\GrumpyBundle\Entity\Groupe|null
     */
    public function getIdGroupe()
    {
        return $this->idGroupe;
    }

    /**
     * Set idUtilisateur.
     *
     * @param \EX\GrumpyBundle\Entity\Utilisateur|null $idUtilisateur
     *
     * @return UserGroupe
     */
    public function setIdUtilisateur(\EX\GrumpyBundle\Entity\Utilisateur $idUtilisateur = null)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur.
     *
     * @return \EX\GrumpyBundle\Entity\Utilisateur|null
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
}
