<?php

namespace Drupal\sipos_hello;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Description of SiposHelloSalutation
 *
 * @author jvanbiervliet
 */
class SiposHelloSalutation {

  use StringTranslationTrait;

  /**
   * SiposHelloSalutation constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Returns the salutation
   */
  public function getSalutation() {
    $config = $this->configFactory->get('sipos_hello.custom_salutation');
    $salutation = $config->get('salutation');
    if ($salutation != "") {
      return $salutation;
    }
    
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
