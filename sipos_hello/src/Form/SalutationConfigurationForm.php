<?php

/**
 * This entire page is a form page
 */

namespace Drupal\sipos_hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * SalutationConfigurationForm definitie om de begroeting boodschap in te stellen.
 * Een Drupal 8 form implementeert FormInterface (impliciet door ConfigFormbase overerving
 * zoals hier het geval is.) ConfigFormBase wdt gebr om configuratie instellingen
 * te bewaren.
 */
class SalutationConfigurationForm extends ConfigFormBase {

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

    $form['salutation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Salutation'),
      '#description' => $this->t('Please provide the salutation.'),
      '#default_value' => $config->get('salutation'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('sipos_hello.custom_salutation')
        ->set('salutation', $form_state->getValue('salutation'))
        ->save();

    parent::submitForm($form, $form_state);
  }

}
