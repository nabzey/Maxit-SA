<?php
namespace App\Entity;
use App\Core\Abstract\AbstractEntity;

class Compte extends AbstractEntity {

    private int $id;
    private string $numerotelephone;
    private ?string $numerocni;
    private ?string $photorecto;
    private ?string $photoverso;
    private float $solde;
    private bool $estprincipale;
    private int $id_personne;
    private string $typecompte;

    public function __construct($id = 0, $numerotelephone = '', $numerocni = null, $typecompte = 'principal', $transactions = [], $id_personne = 0, $solde = 0.0, $estprincipale = false, $photorecto = null, $photoverso = null) {
        $this->id = $id;
        $this->numerotelephone = $numerotelephone;
        $this->numerocni = $numerocni;
        $this->photorecto = $photorecto;
        $this->photoverso = $photoverso;
        $this->solde = $solde;
        $this->estprincipale = $estprincipale;
        $this->id_personne = $id_personne;
        $this->typecompte = $typecompte;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getNumerotelephone(): string {
        return $this->numerotelephone;
    }

    public function getNumerocni(): ?string {
        return $this->numerocni;
    }

    public function getPhotorecto(): ?string {
        return $this->photorecto;
    }

    public function getPhotoverso(): ?string {
        return $this->photoverso;
    }

    public function getSolde(): float {
        return $this->solde;
    }

    public function isEstprincipale(): bool {
        return $this->estprincipale;
    }

    public function getIdPersonne(): int {
        return $this->id_personne;
    }

    public function getTypecompte(): string {
        return $this->typecompte;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNumerotelephone(string $numerotelephone): void {
        $this->numerotelephone = $numerotelephone;
    }

    public function setNumerocni(?string $numerocni): void {
        $this->numerocni = $numerocni;
    }

    public function setPhotorecto(?string $photorecto): void {
        $this->photorecto = $photorecto;
    }

    public function setPhotoverso(?string $photoverso): void {
        $this->photoverso = $photoverso;
    }

    public function setSolde(float $solde): void {
        $this->solde = $solde;
    }

    public function setEstprincipale(bool $estprincipale): void {
        $this->estprincipale = $estprincipale;
    }

    public function setPersonneId(int $id_personne): void {
        $this->id_personne = $id_personne;
    }

    public function setTypecompte(string $typecompte): void {
        $this->typecompte = $typecompte;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'numerotelephone' => $this->numerotelephone,
            'numerocni' => $this->numerocni,
            'photorecto' => $this->photorecto,
            'photoverso' => $this->photoverso,
            'solde' => $this->solde,
            'estprincipale' => $this->estprincipale,
            'id_personne' => $this->id_personne,
            'typecompte' => $this->typecompte
        ];
    }

    public function _toObject($data): object {
        return (object) $data;
    }
    
    public function toJson(): string {
        return json_encode($this->toArray());
    }
}
