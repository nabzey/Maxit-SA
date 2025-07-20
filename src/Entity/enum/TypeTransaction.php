<?php

namespace App\Entity\enum;

enum TypeTransaction: string {
    case DEPOT = 'depot';
    case RETRAIT = 'retrait';
    case PAIEMENT = 'paiement';
}
