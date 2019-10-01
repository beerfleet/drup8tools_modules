<?php

/**
 * So, what is going on here? First, we give the Controller a constructor method, which takes
  our service as an argument and stores it as a property. For me, this is usually the very first
  method in the class. But how does this constructor get its argument? It gets it via the
  create() method, which receives the Service Container as a parameter and is free to
  choose the service(s) needed by the Controller constructor. This is usually my second
  method in a class. I prefer this order because it's very easy to check whether they are
  present. Also, their presence is important, especially when inheriting and observing what
  the parent is injecting.
 * 
 */

namespace Drupal\sipos_hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\sipos_hello\SiposHelloSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/*
 * De route wordt gevonden, waarna deze controller wordt aangeroepen. Er wordt nagegaan of de 
 * controller ContainerInjectionInterface implementeert. In dit geval doet het dat impliciet, want
 * Controllerbase implementeert ContainerInjectionInterface. De controller wordt geïnstantieerd via 
 * de create method en de container wordt ook doorgegeven.
 * 
 */
class SiposHelloController extends ControllerBase {

  /**
   * @var \Drupal\sipos_hello\SiposHelloSalutation
   */
  protected $salutation;

  /**
   * SiposHelloController constructor
   * 
   * @param \Drupal\sipos_hello\SiposHelloSalutation $salutation
   */
  public function __construct(SiposHelloSalutation $salutation) {
    $this->salutation = $salutation;
  }

  public function sipos_hello() {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

  /*
   * Typisch gebruik van dependency injection pattern, is deze create() method.
   * Let wel: NOOIT DE VOLLEDIGE CONTAINER DOORGEVEN.
   * Hier word(t)(en) dus de benodigde service(s) doorgegeven.
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('sipos_hello.salutation')
    );
  }

}
