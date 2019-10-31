<?php

namespace Drupal\sipos_hello;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Description of SiposHelloSalutation
 *
 * @author jvanbiervliet
 */
class SiposHelloSalutation {

  use StringTranslationTrait;
  
  /**
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;
  
  /**
   * SiposHelloSalutation constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   */
  public function __construct(ConfigFactoryInterface $config_factory, EventDispatcherInterface $event_dispatcher) {
    $this->configFactory = $config_factory;
    $this->eventDispatcher = $event_dispatcher;
  }

  /**
   * Returns the salutation
   */
  public function getSalutation() {
    $config = $this->configFactory->get('sipos_hello.custom_salutation');
    $salutation = $config->get('salutation');
    if ($salutation != "") {
      $event = new SiposHelloEvent();
      $event->setValue($salutation);
      $event = $this->eventDispatcher->dispatch(SiposHelloEvent::EVENT, $event);
      return $event->getValue();
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
  
  /**
   * Returns the Salutation render array.
   */
  public function getSalutationComponent() {
    $render = [
      '#theme' => 'sipos_hello_salutation',
    ];
    $config = $this->configFactory->get('sipos_hello.custom_salutation');
    $salutation = $config->get('salutation');
    if ($salutation != "") {
      $render['#salutation'] = $salutation;
      $render['#overridden'] = TRUE;
      return $render;
    }
    $time = new \DateTime();
    $render['#target'] = $this->t('world');
    if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
      $render['#salutation'] = $this->t('Good morning');
      return $render;
    }
    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      $render['#salutation'] = $this->t('Good afternoon');
      return $render;
    }
    if ((int) $time->format('G') >= 18) {
      $render['#salutation'] = $this->t('Good evening');
      return $render;
    }
  }

}
