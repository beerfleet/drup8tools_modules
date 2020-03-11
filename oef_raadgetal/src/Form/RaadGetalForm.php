<?php

namespace Drupal\oef_raadgetal\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * RaadGetalForm
 *
 * @author jvanbiervliet
 */
class RaadGetalForm extends FormBase {

  public function buildForm(array $form, \Drupal\Core\Form\FormStateInterface $form_state): array {
    $form[''];
  }

  public function getFormId(): string {
    return 'oef_raadgetal_form';
  }

  public function submitForm(array &$form, \Drupal\Core\Form\FormStateInterface $form_state) {
    
  }

}
