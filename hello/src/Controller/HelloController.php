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

}
