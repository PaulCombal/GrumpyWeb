<?php

namespace EX\GrumpyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_commande_id_produit", columns={"id_produit"}), @ORM\Index(name="FK_commande_id_utilisateur", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Commande
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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     * })
     */
    private $idUtilisateur;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id")
     * })
     */
    private $idProduit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="statutCommande", type="string", length=25, nullable=true)
     */
    private $statutCommande;





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
     * Set idUtilisateur.
     *
     * @param \EX\GrumpyBundle\Entity\Utilisateur|null $idUtilisateur
     *
     * @return Commande
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

    /**
     * Set idProduit.
     *
     * @param \EX\GrumpyBundle\Entity\Produit|null $idProduit
     *
     * @return Commande
     */
    public function setIdProduit(\EX\GrumpyBundle\Entity\Produit $idProduit = null)
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get idProduit.
     *
     * @return \EX\GrumpyBundle\Entity\Produit|null
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * Set statutCommande.
     *
     * @param string|null $statutCommande
     *
     * @return Commande
     */
    public function setStatutCommande($statutCommande = null)
    {
        $this->statutCommande = $statutCommande;

        return $this;
    }

    /**
     * Get statutCommande.
     *
     * @return string|null
     */
    public function getStatutCommande()
    {
        return $this->statutCommande;
    }
}
