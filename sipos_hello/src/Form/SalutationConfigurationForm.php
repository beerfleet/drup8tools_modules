<?php

/**
 * This entire page is a CONFIGURATION (/admin) form page
 */

namespace Drupal\sipos_hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Logger\LoggerChannelInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * SalutationConfigurationForm definitie om de begroeting boodschap in te stellen.
 * Een Drupal 8 form implementeert FormInterface (impliciet door ConfigFormbase overerving
 * zoals hier het geval is.) ConfigFormBase wdt gebr om configuratie instellingen
 * te bewaren.
 */
class SalutationConfigurationForm extends ConfigFormBase {

  protected $logger;

  /**
   * 
   * @param ConfigFactoryInterface $config_factory
   *  The factory for config objects
   * @param LoggerChannelInterface $logger
   *  The logger
   */
  public function __construct(ConfigFactoryInterface $config_factory, LoggerChannelInterface $logger) {
    parent::__construct($config_factory);
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('sipos_hello.logger.channel.sipos_hello')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['sipos_hello.custom_salutation'];
  }

  /**
   * {@inheritdoc}
   * unieke machine naam van de form
   */
  public function getFormId(): string {
    return 'salutation_configuration_form';
  }

  /**
   * {@inheritdoc}
   * Returnt de form definitie
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('sipos_hello.custom_salutation');

    $form['#cache']['max-age'] = 0;
    $form['#attributes']['novalidate'] = 'novalidate';

    $form['salutation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Salutation'),
      '#description' => $this->t('Please provide the salutation.'),
      '#default_value' => $config->get('salutation'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $previous_salutation = $this->config('sipos_hello.custom_salutation')
        ->get('salutation');
    
    $this->config('sipos_hello.custom_salutation')
        ->set('salutation', $form_state->getValue('salutation'))
        ->save();

    parent::submitForm($form, $form_state);

    $this->logger->info('The Sipos Sello salutation has been changed from "@previous" to "@message".', ['@previous' => $previous_salutation, '@message' => $form_state->getValue('salutation')]);
    
    /* This is an entry point for the SiposMailLogger functionality */
    $this->logger->error('THIS IS AN ERROR LOG TO MAIL MAYBE ...?', ['@previous' => $previous_salutation, '@message' => $form_state->getValue('salutation')]);
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $form['#cache']['max-age'] = 0;
    $salutation = $form_state->getValue('salutation');

    if (strlen($salutation) < 3) {
      $form_state->setErrorByName('salutation', 'Salutation is too short.');
    }

    // If validation errors, add inline errors
    if ($errors = $form_state->getErrors()) {
      $accessor = PropertyAccess::createPropertyAccessor();
      foreach ($errors as $field => $error) {
        if ($accessor->getValue($form, "[$field]")) {
          $accessor->setValue($form, "[$field]" . '[#prefix]', '<div class="form-group error">');
          $accessor->setValue($form, "[$field]" . '[#suffix]', '<div class="input-error-desc">' . $error . '</div></div>');
        }
      }
    }
  }

}
