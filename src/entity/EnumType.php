<?php

  namespace   App\Entity;
  use App\Entity\EnumType;



enum EnumType: string {
    case Depot = 'depot';
    case Retrait = 'retrait';
    case Paiement = 'paiement';
}