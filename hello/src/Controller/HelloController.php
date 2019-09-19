<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {

  public function helloNerds() {
    return [
      '#markup' => hello_hello_world()
    ];
  }

  public function welcome() {
    return [
      '#markup' => hello_welcome(),
    ];
  }

  public function create_node() {
    return [
      '#markup' => hello_create_node(),
    ];
  }

  public function create_file() {
    return [
      '#markup' => hello_create_file(),
    ];
  }
}
