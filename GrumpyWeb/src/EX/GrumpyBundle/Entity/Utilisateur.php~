<?php

namespace EX\GrumpyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", indexes={@ORM\Index(name="FK_utilisateur_id_panier", columns={"id_panier"})})
 * @ORM\Entity
 */
class Utilisateur extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=25, nullable=true)
     */
    protected $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=25, nullable=true)
     */
    protected $prenom;

    /**
     * @var \Panier
     *
     * @ORM\ManyToOne(targetEntity="Panier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_panier", referencedColumnName="id")
     * })
     */
    protected $idPanier;


    /**
     * Set nom.
     *
     * @param string|null $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom = null)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string|null
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom.
     *
     * @param string|null $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom = null)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string|null
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set idPanier.
     *
     * @param \EX\GrumpyBundle\Entity\Panier|null $idPanier
     *
     * @return Utilisateur
     */
    public function setIdPanier(\EX\GrumpyBundle\Entity\Panier $idPanier = null)
    {
        $this->idPanier = $idPanier;

        return $this;
    }

    /**
     * Get idPanier.
     *
     * @return \EX\GrumpyBundle\Entity\Panier|null
     */
    public function getIdPanier()
    {
        return $this->idPanier;
    }
}
