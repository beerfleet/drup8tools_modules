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

  function start() {
    $raad_form = \Drupal::formBuilder()->getForm('Drupal\oef_raadgetal\Form\RaadGetalForm');
    $build = [
      '#theme' => 'oef_raadgetal_start_pagina',
      '#form' => $raad_form,
    ];
    return $build;
  }

}
