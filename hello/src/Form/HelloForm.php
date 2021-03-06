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

    // textfield
    $form['job_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Job Title'),
      '#description' => $this->t('Enter your job title. At least 5 chars in length, please, kind sir. Thank you. Come again.'),
      '#required' => TRUE,
    );

    // checkboxes
    $form['tests_taken'] = [
      '#type' => 'checkboxes',
      '#options' => ['SAT' => $this->t('SAT'), 'ACT' => t('ACT')],
      '#title' => $this->t('What standardized tests did you take ?'),
      '#description' => $this->t('No tests taken = no checkboxes checked.'),
    ];

    // Color.
    $form['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => '#ffffff',
      '#description' => $this->t('Pick a color by clicking on the color above'),
    ];

    // Date
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Enter your email address'),
    ];

    // Number
    $form['quantity'] = [
      '#type' => 'number',
      '#title' => $this->t('Quantity'),
      '#description' => $this->t('Enter a number, any number'),
    ];

    // field set
    $form['password'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Password'),
    ];

    // Password
    $form['password']['field'] = [
      '#type' => 'password',
      '#title' => $this->t('Old Password'),
      '#description' => $this->t('Enter a password')
    ];

    // Password confirm
    $form['password']['field_confirm'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('Confirm password'),
      '#description' => $this->t('Confirm your password.'),
    ];

    // Range
    $form['size'] = [
      '#type' => 'range',
      '#title' => $this->t('Size'),
      '#min' => 10,
      '#max' => 100,
      '#description' => $this->t('Slider control. Ole ole'),
    ];

    // Radios
    $form['settings']['active'] = [
      '#type' => 'radios',
      '#title' => $this->t('Poll status'),
      '#options' => [0 => $this->t('Open'), 1 => $this->t('Closed')],
      '#description' => $this->t('Select Open or closed'),
    ];

    //Search
    $form['search'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Search Group'),
    ];

    $form['search']['search'] = [
      '#type' => 'search',
      '#title' => $this->t('Search'),
      '#description' => $this->t('Search something'),
    ];

    $form['search']['favorite'] = [
      '#type' => 'select',
      '#title' => $this->t('Favorite color'),
      '#options' => [
        'red' => $this->t('Red'),
        'yellow' => $this->t('Yellow'),
        'blue' => $this->t('Blue'),
      ],
      '#empty_option' => $this->t('-select-'),
      '#description' => $this->t('My favorite color is: '),
    ];

    // tel
    $form['search']['tel'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone'),
      '#description' => $this->t('Enter phony number.'),
    ];

    // tableSelect
    $options = [
      1 => ['first_name' => 'Aaron', 'last_name' => 'Hurst'],
      2 => ['first_name' => 'Alan', 'last_name' => 'Greenspan'],
      3 => ['first_name' => 'Agatha', 'last_name' => 'Christie'],
    ];

    $header = [
      'first_name' => $this->t('First Name'),
      'last_name' => $this->t('Last Name'),
    ];

    $form['table'] = [
      '#type' => 'tableselect',
      '#title' => $this->t('Users'),
      '#title_display' => 'visible',
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No users found'),
    ];

    $form['texts'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Some textboxes here'),
    ];

    $form['texts']['text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Text'),
      '#description' => $this->t('A whole lot of letters can go here.'),
    ];

    $form['texts']['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subject'),
      '#size' => 60,
      '#ùaxlength' => 128,
      '#description' => $this->t('Just another text field'),
    ];

    $form['texts']['weight'] = [
      '#type' => 'weight',
      '#title' => $this->t('Weight'),
      '#description' => $this->t('Drupal weight control.'),
    ];

    $form['actions'] = array(
      '#type' => 'actions',
    );

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

    $form['actions']['submit']['#attributes']['class'][] = 'btn-block';


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
    // Find out what was submitted
    $values = $form_state->getValues();
    foreach ($values as $key => $value) {
      $label = isset($form[$key]['#title']) ? $form[$key]['#title'] : $key;

      // Many arrays return 0 for unselected vamues, filter these out !
      if (is_array($value)) {
        $value = array_filter($value);
      }
      
      // Only display for controls with titles and values
      if ($value && $label) {
        $display_value = is_array($value) ? preg_replace('/[\n\r\s]+/', ' ', print_r($value, 1)) : $value;
        $message = $this->t('Value for %title: %value', ['%title' => $label, '%value' => $display_value]);
        drupal_set_message($message);
      }
    }
  }
}
