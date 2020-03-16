<?php

namespace Drupal\oef_raadgetal\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\oef_raadgetal\Services\RaadGetalServices;

/**
 * RaadGetalForm
 *
 * @author jvanbiervliet
 */
class RaadGetalForm extends FormBase {

  protected $services;

  function __construct($services) {
    $this->services = $services;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['#theme'] = 'oef_raadgetal_raad_form';
    $form['getal'] = [
      '#type' => 'number',
      '#title' => $this->t('Getal')
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'oef_raadgetal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $getal = $form_state->getValue('getal');
    if ($getal < 0 || $getal > 10) {
      $form_state->setErrorByName('getal', "Getal moet tussen 1 en 10 zijn");
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->services->try($form_state->getValue('getal'));
    
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format' ? $value['value'] : $value));
    }
  }

  public static function create(ContainerInterface $container) {
    $services = $container->get('oef_raadgetal.logica');
    return new static($services);
  }

}
