<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\oef_raadgetal\Controller;

use \Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\oef_raadgetal\RaadGetalServices;

/**
 * RaadGetalController
 *
 * @author jvanbiervliet
 */
class RaadGetalController extends ControllerBase {

  protected $services;

  function __construct($services) {
    $this->services = $services;
  }

  function start() {
    /* @var Drupal\oef_raadgetal\RaadGetalServices $services */
    $this->services->
    $form = \Drupal::formBuilder()->getForm('Drupal\oef_raadgetal\Form\RaadGetalForm');
    $build = [
      '#theme' => 'oef_raadgetal_start_pagina',
      '#mijn_form' => $form,
    ];
    return $build;
  }

  public static function create(ContainerInterface $container) {
    $services = $container->get('oef_raadgetal.services');
//    parent::create($container);
    return new static($services);
  }

}
