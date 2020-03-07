<?php

namespace Drupal\d8md_hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\d8md_hello\HiSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for hi's
 *
 * @author jvanbiervliet
 */
class HiController extends ControllerBase {

  protected $salutation;

  /**
   * HelloWorldController constructor.
   *
   * @param \Drupal\hello_world\HiSalutation $salutation
   */
  public function __construct(HiSalutation $salutation) {
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('d8md_hello.hi')
    );
  }

  /**
   * Hi.
   *
   * @return array
   */
  function hi() {
    /* @var HiSalutation $this->salutation */
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

  function insultation($person) {
    return new Response("Horale, Siick my daack $person");
  }

}
