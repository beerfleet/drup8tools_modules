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
    $build['#theme'] = 'oef_raadgetal_start_pagina';
    return $build;
  }

}
