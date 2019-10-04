<?php

namespace Drupal\sipos_hello;

use Symfony\Component\EventDispatcher\Event;

/**
 * Description of SiposHelloEvent
 *
 * @author jvanbiervliet
 */
class SiposHelloEvent extends Event {

  const EVENT = 'sipos_hello.sipos_hello_event';

  /**
   * Salutation message
   * 
   * @var string
   */
  protected $message;

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->message;
  }

  /**
   * @param mixed $message
   */
  public function setValue($message) {
    $this->message = $message;
  }

}
