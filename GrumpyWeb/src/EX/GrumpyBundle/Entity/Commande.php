<?php

namespace EX\GrumpyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_commande_id_produit", columns={"id_produit"}), @ORM\Index(name="FK_commande_id_panier", columns={"id_panier"})})
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
     * @var \Panier
     *
     * @ORM\ManyToOne(targetEntity="Panier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_panier", referencedColumnName="id")
     * })
     */
    private $idPanier;

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
     * Set idPanier.
     *
     * @param \EX\GrumpyBundle\Entity\Panier|null $idPanier
     *
     * @return Commande
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
