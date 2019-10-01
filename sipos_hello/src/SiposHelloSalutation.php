<?php

namespace Drupal\sipos_hello;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Description of SiposHelloSalutation
 *
 * @author jvanbiervliet
 */
class SiposHelloSalutation {

  use StringTranslationTrait;

  /**
   * Returns the salutation
   */
  public function getSalutation() {
    $time = new \DateTime();

    if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
      return $this->t('Good morning ole folkes');
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      return $this->t('Good afternoon lazy bums');
    }

    if ((int) $time->format('G') >= 18) {
      return $this->t('Good evening vampire peeps.');
    }
  }
}
