<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Expansion on HelloForm
 *
 * @author jvanbiervliet
 */
class HelloForm extends FormBase {

  //put your code here
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['job_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Job Title'),
      '#description' => $this->t('Enter your job title. At least 5 chars in length, please, kind sir. Thank you. Come again.'),
      '#required' => TRUE,
    );

    $form['actions'] = array(
      '#type' => 'actions',
    );

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

    return $form;
  }

  public function getFormId(): string {
    return 'hello_form';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $job_title = $form_state->getValue('job_title');
    if (strlen($job_title) < 5) {
      // set error for the form element with a key of "title".
      $form_state->setErrorByName('job_title', $this->t('Your job title must be at least 5 chars long.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    /*
     * This would normally be replaced by code that actually does something with the title.
     */
    $job_title = $form_state->getValue('job_title');
    drupal_set_message(t('You specified a job title of %job_title.', ['%job_title' => $job_title]));
  }

}
