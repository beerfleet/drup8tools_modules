<?php

namespace Drupal\sipos_hello\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\sipos_hello\SiposHelloEvent;

/**
 * Class SiposHelloModifySalutation.
 */
class SiposHelloModifySalutation implements EventSubscriberInterface {

  /**
   * Constructs a new SiposHelloModifySalutation object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[SiposHelloEvent::EVENT] = ['onGetSalutation', 0];

    return $events;
  }

  /**
   * This method is called when the onGetSalutation is dispatched.
   *
   * @param \Drupal\sipos_hello\SiposHelloEvent $event
   *   The dispatched event.
   */
  public function onGetSalutation(SiposHelloEvent $event) {
    $event->setValue("WAKA WAKA SALUTATION TJAKKA");
  }

}
