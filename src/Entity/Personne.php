<?php
namespace App\Entity;
use App\Core\Abstract\AbstractEntity;

class Personne extends AbstractEntity {

    private int $id;
    private string $nom;
    private string $prenom;
    private string $adresse;
    private string $telephone;
    private string $photorecto;
    private string $photoverso;
    private string $numerocni;
    private string $login;
    private string $password;
    private ?Compte $compteId=null;
    private string $typepersonne ;

public function __construct($id=0, $nom='', $prenom='', $adresse='', $telephone='', $photorecto='', $photoverso='', $numerocni='', $login='', $password='', $typepersonne='client') {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->photorecto = $photorecto;
        $this->photoverso = $photoverso;
        $this->numerocni = $numerocni;
        $this->login = $login;
        $this->password = $password;
        $this->compteId = null;
        $this->typepersonne = $typepersonne ?: 'client'; // Défaut client si vide
    }

    public function getId(): int {
        return $this->id;
    }          

    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getNom(): string {
        return $this->nom;
    }



    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    public function getPrenom(): string {
        return $this->prenom;
    }
    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }
    public function getAdresse(): string {
        return $this->adresse;
    }
    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }
    public function getTelephone(): string {
        return $this->telephone;
    }
    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;

    }
    public function getPhotorecto(): string {
        return $this->photorecto;
    }
    public function setPhotorecto(string $photorecto): void {
        $this->photorecto = $photorecto;
    }
    public function getPhotoverso(): string {
        return $this->photoverso;
    }
    public function setPhotoverso(string $photoverso): void {
        $this->photoverso = $photoverso;
    }
    public function getNumerocni(): string {
        return $this->numerocni;
    }
    public function setNumerocni(string $numerocni): void {
        $this->numerocni = $numerocni;
    }
    public function getLogin(): string {
        return $this->login;
    }
    public function setLogin(string $login): void {
        $this->login = $login;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function setPassword(string $password): void {
        $this->password = $password;
    }
    public function getCompteId() {
        return $this->compteId;
    }
    public function setCompteId( $compteId): void {
        $this->compteId = $compteId;
}
    public function getTypepersonne(): string {
        return $this->typepersonne;
    }
    public function setTypepersonne(string $typepersonne): void {
        $this->typepersonne = $typepersonne;
    }
    public function toarray(): array {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'adresse' => $this->adresse,
            'telephone' => $this->telephone,
            'photorecto' => $this->photorecto,
            'photoverso' => $this->photoverso,
            'numerocni' => $this->numerocni,
            'login' => $this->login,
            'password' => $this->password,
            'compteId' => $this->compteId,
            'typepersonne' => $this->typepersonne
        ];
    }

    public function _toObject($data): object {
        return (object) $data;
    }
    
    public function toJson(): string {
        return json_encode($this->toArray());
    }
  
}