<?php

  namespace   App\Entity;
  use App\Entity\EnumStatu;

 enum EnumStatu : string {

  case Principale = 'principale';
  case Secondaire = 'secondaire';
 }
