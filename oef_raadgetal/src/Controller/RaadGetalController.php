<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\oef_raadgetal\Controller;

use \Drupal\Core\Controller\ControllerBase;

/**
 * RaadGetalController
 *
 * @author jvanbiervliet
 */
class RaadGetalController extends ControllerBase {
  
  const GETAL = "raad_getal_waarde";
  const POGINGEN = "raad_getal_pogingen";

  function init_state() {
    $this->set_random_number();
  }

  function set_random_number() {
    \Drupal::state()->set(self::GETAL, rand(1,10));
    \Drupal::state()->set(self::POGINGEN, 3);
  }

  function start() {
    $this->init_state();
    $form = \Drupal::formBuilder()->getForm('Drupal\oef_raadgetal\Form\RaadGetalForm');
    $build = [
      '#theme' => 'oef_raadgetal_start_pagina',
      '#mijn_form' => $form,
    ];
    return $build;
  }

}
