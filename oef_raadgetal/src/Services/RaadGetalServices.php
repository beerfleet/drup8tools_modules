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

  public function __construct() {
    $this->init_state();
  }

  function reset_state() {
    $this->set_initial_values();
  }

  function init_state() {
    if (null === \Drupal::state()->get(self::GETAL)) {
      $this->set_initial_values();
    }
  }

  function set_initial_values() {
    \Drupal::state()->set(self::GETAL, rand(1, 10));
    \Drupal::state()->set(self::POGINGEN, 3);
  }

  function get_getal() {
    return \Drupal::state()->get(self::GETAL);
  }
  
  function get_pogingen() {
    return \Drupal::state()->get(self::POGINGEN);
  }

}
