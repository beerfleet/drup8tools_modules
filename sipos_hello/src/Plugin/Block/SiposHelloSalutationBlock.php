<?php

namespace Drupal\sipos_hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\sipos_hello\SiposHelloSalutation as SiposHelloSalutationService;
use Drupal\Core\Form\FormStateInterface;

/* THIS ANNOTAITON DENOTES THAT THIS CLASS IS A BLOCK PLUGIN */

/**
 * Sipos Hello Salutation block
 *
 * @Block(
 *   id = "sipos_hello_salutation_block",
 *   admin_label = @Translation("Sipos Hello Salutation"),
 *   category = @Translation("Sipos Hello"),
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
   * A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   * The plugin_id for the plugin instance.
   * @param string $plugin_definition
   * The plugin implementation definition.
   * @param \Drupal\hello_world\SiposHelloSalutation $salutation 
   * The salutation service.
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

  public function defaultConfiguration() {
    return [
      'enabled' => 1,
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    $form['enabled'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#description' => t('Check this box if you want to enable this feature.'),
      '#default_value' => $config['enabled'],
    );
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['enabled'] = $form_state->getValue('enabled');
  }

}
