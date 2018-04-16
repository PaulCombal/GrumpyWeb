<?php

namespace EX\GrumpyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="FK_commentaire_id_utilisateur", columns={"id_utilisateur"}), @ORM\Index(name="FK_commentaire_id_evenement", columns={"id_evenement"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @var string|null
     *
     * @ORM\Column(name="contenu", type="string", length=25, nullable=true)
     */
    private $contenu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_contenu", type="string", length=25, nullable=true)
     */
    private $typeContenu;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id")
     * })
     */
    private $idEvenement;

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
     * Set contenu.
     *
     * @param string|null $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu = null)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu.
     *
     * @return string|null
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set typeContenu.
     *
     * @param string|null $typeContenu
     *
     * @return Commentaire
     */
    public function setTypeContenu($typeContenu = null)
    {
        $this->typeContenu = $typeContenu;

        return $this;
    }

    /**
     * Get typeContenu.
     *
     * @return string|null
     */
    public function getTypeContenu()
    {
        return $this->typeContenu;
    }

    /**
     * Set idEvenement.
     *
     * @param \EX\GrumpyBundle\Entity\Evenement|null $idEvenement
     *
     * @return Commentaire
     */
    public function setIdEvenement(\EX\GrumpyBundle\Entity\Evenement $idEvenement = null)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement.
     *
     * @return \EX\GrumpyBundle\Entity\Evenement|null
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set idUtilisateur.
     *
     * @param \EX\GrumpyBundle\Entity\Utilisateur|null $idUtilisateur
     *
     * @return Commentaire
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
