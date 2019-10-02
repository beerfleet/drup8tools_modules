<?php

namespace Drupal\sipos_hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\sipos_hello\SiposHelloSalutation as SiposHelloSalutationService;

/* THIS ANNOTAITON DENOTES THAT THIS CLASS IS A BLOCK PLUGIN */

/**
 * Sipos Hello Salutation block
 *
 * @Block(
 *   id = "sipos_hello_salutation_block",
 *   admin_label = @Translation("Sipos Hello Salutation"),
 *   category = @Translation("Hello World"),
 * )
 */
class SiposHelloSalutationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   *  @var \Drupal\sipos_hello\SiposHelloSalutation 
   */
  protected $salutation;

  /**
   * Construct.
   *
   * @param array $configuration
   * A configuration array containing information about the plugin
    instance.
   * @param string $plugin_id
   * The plugin_id for the plugin instance.
   * @param string $plugin_definition
   * The plugin implementation definition.
   * @param \Drupal\hello_world\HelloWorldSalutation $salutation * The
    salutation service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, SiposHelloSalutationService $salutation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(array $configuration, $plugin_id, $plugin_definition, ContainerInterface $container) {
    return new static(
        $configuration, $plugin_id, $plugin_definition, $container->get('sipos_hello.salutation')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

}
