<?php

/**
 * @file
 * Contains \Drupal\drupalform\Form\ExampleForm.
 * */

namespace Drupal\drupalform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalform_example_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['company_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Company name'),
    );
    $form['telefoon'] = [
      '#type' => 'tel',
      '#title' => $this->t('Telefoonnummer'),
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('E-mailadres'),
    ];
    $form['number'] = [
      '#type' => 'number',
      '#title' => $this->t('Nummer'),
    ];
    $form['leeftijd'] = [
      '#type' => 'range',
      '#title' => $this->t('Nummer'),
      '#value' => "16",
      '#min' => "16",
      '#max' => "99",
      '#step' => "1",
    ];
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
// Validation covered in later recipe, required to satisfy interface
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
// Validation covered in later recipe, required to satisfy interface
  }

}
