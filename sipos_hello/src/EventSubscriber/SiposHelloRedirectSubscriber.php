<?php

namespace Drupal\sipos_hello\EventSubscriber;

use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;

/**
 * Subscribes to the Kernel Request event and redirects to the homepage
 * when the user has the "non_grata" role.
 */
class SiposHelloRedirectSubscriber implements EventSubscriberInterface {

  /**
   *
   * @var \Drupal\Core\Session\AccountProxy $currentUser
   */
  protected $currentUser;

  /**
   * SiposHelloRedirectSubscriber constructor.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   */
  public function __construct(AccountProxyInterface $current_user) {
    //$this->currentUser = $current_user;
    $this->currentUser = $current_user;
    echo '<pre>';
    var_dump($current_user);
    echo '</pre>';
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    /*
     * EventSubscriberInterface method: Listener voor event kernel.request. 
     * onRequest() method zal uitgevoerd worden met prioriteit 0. Hoe groter 
     * dit getal, hoe eerder in dit proces hat zal uitvoeren. Check de docu
     * van de interface zelf om na te gaan op welke manieren je voor een event 
     * kan registreren.
     */
    $events['kernel.request'][] = ['onRequest', 1000];
    return $events;
  }

  /**
   * Handler for the kernel request event.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {
    $request = $event->getRequest();
    $path = $request->getPathInfo();
    if ($path !== '/sipos/hello') {
      return;
    }

    $roles = $this->currentUser->getRoles();
    if (in_array('persona_non_grata', $roles)) {
      $event->setResponse(new RedirectResponse('/'));
    }
  }

}
