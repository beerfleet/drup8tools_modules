<?php

namespace Drupal\sipos_hello\EventSubscriber;

use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Url;
use Drupal\Core\Routing\LocalRedirectResponse;

/**
 * Subscribes to the Kernel Request event and redirects to the homepage
 * when the user has the "non_grata" role.
 */
class SiposHelloRedirectSubscriber implements EventSubscriberInterface {

  /**
   * @var \Drupal\Core\Session\AccountProxy $currentUser
   */
  protected $currentUser;
  
  /**
   * @var \Drupal\Core\Routing\CurrentRouteMatch $currentRoute
   */
  protected $currentRoute;

  /**
   * SiposHelloRedirectSubscriber constructor.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   */
  public function __construct(AccountProxyInterface $current_user, CurrentRouteMatch $current_route_match) {
    //$this->currentUser = $current_user;
    $this->currentUser = $current_user;
    $this->currentRoute = $current_route_match;
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
    $events[KernelEvents::REQUEST][] = ['onRequest', 0];
    return $events;
  }

  /**
   * Handler for the kernel request event.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {
    $route_name = $this->currentRoute->getRouteName();
    
    if ($route_name !== 'sipos_hello.hello') {
      return;
    }
    
    $roles = $this->currentUser->getRoles();
    if (in_array('persona_non_grata', $roles)) {
      $url = Url::fromUri('internal:/');
      $event->setResponse(new LocalRedirectResponse($url->toString()));
    }
  }

}
