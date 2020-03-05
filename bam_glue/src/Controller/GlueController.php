<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\bam_glue\Controller;

/**
 * Description of GlueController
 *
 * @author jvanbiervliet
 */
class GlueController {

  public function helloWorldPage() {
    return array(
      '#markup' => t('<p>Hello, horse!</p>'),
    );
  }

}
