<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\d8md_hello;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Description of HiSalutation
 *
 * @author jvanbiervliet
 */
class HiSalutation {

  use StringTranslationTrait;
  
  /* @var  ConfigFactoryInterface $configfactory */
  protected $configfactory;
  
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configfactory = $config_factory;
  }

  /**
   * Returns the salutation
   */
  public function getSalutation() {
    $conf = $this->configfactory->get('d8md_hello.custom_hi');
    $salutation = $conf->get('salutation');
    if ($salutation != "") {
      return $salutation;
    }
    
    $keuze = rand(1, 10);
    switch ($keuze) {
      case 1:
        $salutation = 'Yo, bro';
        break;
      case 2:
        $salutation = 'Arigato, comegato';
        break;
      case 3:
        $salutation = 'Hoi the\'re';
        break;
      case 4:
        $salutation = 'Sakondis';
        break;
      case 5:
        $salutation = 'Huh ?';
        break;
      case 6:
        $salutation = 'Hola Compadre';
        break;
      case 7:
        $salutation = 'No spiki Engrish';
        break;
      case 8:
        $salutation = 'Goedendaag';
        break;
      case 9:
        $salutation = 'Bonsour';
        break;
      case 10:
        $salutation = 'Astalavista, baby';
        break;
    }

    return $this->t($salutation);
  }

}
