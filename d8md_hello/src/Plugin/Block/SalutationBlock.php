<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\d8md_hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\d8md_hello\HiSalutation as HiSalutationService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * d8md_hello Salutation block.
 *
 * @Block(
 * id = "d8md_hello_salutation_block",
 * admin_label = @Translation("Hi salutation"),
 * )
 */
class SalutationBlock extends BlockBase implements
ContainerFactoryPluginInterface {

  /**
   * The salutation service.
   *
   * @var \Drupal\d8md_hello\HiSalutation
   */
  protected $salutation;

  /**
   * Construct.
   *
   * @param array $configuration
   * A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   * The plugin_id for the plugin instance.
   * @param string $plugin_definition
   * The plugin implementation definition.
   * @param \Drupal\d8md_hello\HiSalutation $salutation 
   * The salutation service.
   */
  public function __construct(array $configuration, $plugin_id,
    $plugin_definition, HiSalutationService $salutation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array
    $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('d8md_hello.hi')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
  }

}
