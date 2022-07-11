<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\SerializerInterface;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[Uploadable]
class Produit implements SerializerInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $couleur = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $taille = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $collection = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $photo = null;

    #[UploadableField(mapping: 'produits', fileNameProperty: 'photo')]
    #[Ignore]
    private ?File $fichier = null;

    #[ORM\Column(type: 'float')]
    private float $prix = 0.0;

    #[ORM\Column(type: 'integer')]
    private int $stock = 0;

    #[ORM\Column(type: 'datetime_immutable', length: 255)]
    private \DateTimeImmutable $date_enregistrement;

    public function __construct()
    {
        $this->date_enregistrement = new \DateTimeImmutable();
    }

    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFichier(?File $fichier = null): self
    {
        $this->fichier = $fichier;
        if ($this->fichier instanceof UploadedFile) {
            $this->date_enregistrement = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getFichier(): ?File
    {
        return $this->fichier;
    }


    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function setCollection(string $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeImmutable
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeImmutable $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

    public function serialize(mixed $data, string $format, array $context = []): string
    {
        // TODO: Implement serialize() method.
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        // TODO: Implement deserialize() method.
    }
}
