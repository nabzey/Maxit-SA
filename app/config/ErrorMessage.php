<?php
namespace App\Config;

enum ErrorMessage: string
{
    case required = 'Ce champ est requis.';
    case invalidLength = "Longueur invalide.";
    case invalidEmail = "Email invalide.";
    case invalidPassword = "Mot de passe invalide (8 caractères, majuscule, minuscule, chiffre, caractère spécial).";
    case  invalidPhone = "Numéro de téléphone sénégalais invalide.";
    case invalidCni = "Numéro CNI invalide (doit commencer par 1 et contenir 13 chiffres).";
    case accountCreationError = "Error de creation de compte";
    case isValide ="Identifiant invalide";
    case invalideIdentifiant="Identifiants sont invalides";
}
