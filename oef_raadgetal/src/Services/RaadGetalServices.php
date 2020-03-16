<?php

/*
 * 
 */

namespace Drupal\oef_raadgetal\Services;

/**
 * @author jvanbiervliet
 */
class RaadGetalServices {

  const GETAL = "raad_getal_waarde";
  const POGINGEN = "raad_getal_pogingen";

  function init_state() {
    $this->set_random_number();
  }

  function set_random_number() {
    \Drupal::state()->set(self::GETAL, rand(1, 10));
    \Drupal::state()->set(self::POGINGEN, 3);
  }
  
  function get_random_number() {
    return \Drupal::state()->get(self::GETAL);
  }

  public function __construct() {
    $this->init_state();
  }

}
