<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Video $video = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Photo::class)]
    private Collection $photos;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'produits')]
    private Collection $categories;

    #[ORM\Column]
    private ?float $prixVente = null;

    #[ORM\Column]
    private ?int $qteStock = null;

    #[ORM\Column]
    private ?int $qteAlerte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: LigneAchat::class)]
    private Collection $ligneAchats;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?bool $isArrivage = null;

    #[ORM\Column]
    private ?bool $isBestSelling = null;

    
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->ligneAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setProduit($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProduit() === $this) {
                $photo->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getQteStock(): ?int
    {
        return $this->qteStock;
    }

    public function setQteStock(int $qteStock): self
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    public function getQteAlerte(): ?int
    {
        return $this->qteAlerte;
    }

    public function setQteAlerte(int $qteAlerte): self
    {
        $this->qteAlerte = $qteAlerte;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, LigneAchat>
     */
    public function getLigneAchats(): Collection
    {
        return $this->ligneAchats;
    }

    public function addLigneAchat(LigneAchat $ligneAchat): self
    {
        if (!$this->ligneAchats->contains($ligneAchat)) {
            $this->ligneAchats->add($ligneAchat);
            $ligneAchat->setProduit($this);
        }

        return $this;
    }

    public function removeLigneAchat(LigneAchat $ligneAchat): self
    {
        if ($this->ligneAchats->removeElement($ligneAchat)) {
            // set the owning side to null (unless already changed)
            if ($ligneAchat->getProduit() === $this) {
                $ligneAchat->setProduit(null);
            }
        }

        return $this;
    }

    public function isIsArrivage(): ?bool
    {
        return $this->isArrivage;
    }

    public function setIsArrivage(bool $isArrivage): self
    {
        $this->isArrivage = $isArrivage;

        return $this;
    }

    public function isIsBestSelling(): ?bool
    {
        return $this->isBestSelling;
    }

    public function setIsBestSelling(bool $isBestSelling): self
    {
        $this->isBestSelling = $isBestSelling;

        return $this;
    }

}
