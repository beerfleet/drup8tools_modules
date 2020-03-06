<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\d8md_hello;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Description of HiSalutation
 *
 * @author jvanbiervliet
 */
class HiSalutation {

  use StringTranslationTrait;

  /**
   * Returns the salutation
   */
  public function getSalutation() {
    $keuze = rand(1, 10);
    $grut = 'NOTHING';

    switch ($keuze) {
      case 1:
        $grut = 'Yo, bro';
        break;
      case 2:
        $grut = 'Arigato, comegato';
        break;
      case 3:
        $grut = 'Hoi the\'re';
        break;
      case 4:
        $grut = 'Sakondis';
        break;
      case 5:
        $grut = 'Huh ?';
        break;
      case 6:
        $grut = 'Hola Compadre';
        break;
      case 7:
        $grut = 'No spiki Engrish';
        break;
      case 8:
        $grut = 'Goedendaag';
        break;
      case 9:
        $grut = 'Bonsour';
        break;
      case 10:
        $grut = 'Astalavista, baby';
        break;
    }

    return $this->t($grut);
  }

}
