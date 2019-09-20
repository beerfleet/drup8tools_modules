<?php

namespace Drupal\moduletemplate\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for New Module Template
 */
class ModuletemplateController extends ControllerBase {
  
  public function customPage($word = 'emptyness') {
    return [
      '#markup' => t('Welcome to my custom page, @word', [
        '@word' => $word,
      ])
    ];
  }
}
