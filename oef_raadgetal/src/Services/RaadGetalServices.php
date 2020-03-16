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
  
  function verminder_pogingen() {
    $aantal_pogingen = $this->get_pogingen();
    if ($aantal_pogingen > 0) {
      $aantal_pogingen -= 1;
      $this->set_pogingen($aantal_pogingen);
    }
  }
  
  function set_pogingen($aantal) {
    \Drupal::state()->set(self::POGINGEN, $aantal);
  }

  function get_pogingen() {
    return \Drupal::state()->get(self::POGINGEN);
  }

  function try($getal) {
    if ($getal != $this->get_getal()) {
      $this->verminder_pogingen();
    }
  }

}
