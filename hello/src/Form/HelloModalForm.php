<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax;
use Drupal\Core\Ajax\OpenModalDialogCommand;

/**
 * Description of HelloModalForm
 *
 * @author jvanbiervliet
 */
class HelloModalForm extends FormBase {

  //put your code here
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';

    $form['node_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Node\'s title'),
      '#description' => $this->t('Enter portion of title to search for'),
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search'),
      '#ajax' => [// here we add Ajax callback where we will process
        'callback' => '::open_modal', // the data that came from the form and 
      // that we will receive as a result in the modal window
      ],
    ];

    $form['#title'] = 'Search for Node by Title';

    return $form;
  }

  public function getFormId(): string {
    return 'hello_modal_form';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    
  }

  private function get_options() {
    return [
      'dialogClass' => 'popup-dialog-class',
      'width' => '300',
      'height' => '300'
    ];
  }

  public function open_modal(array &$form, FormStateInterface $form_state) {
    $node_title = $form_state->getValue('node_title');
    $query = \Drupal::entityQuery('node')
        ->condition('title', $node_title, 'CONTAINS');
    $entity = $query->execute();
    $key = array_keys($entity);
    $id = !empty($key[0]) ? $key[0] : NULL;
    $response = new AjaxResponse();
    $title = 'Node ID';
    $options = $this->get_options();
    if ($id !== NULL) {
      $content = '<div class="test-popup-content">Node ID is: ' . $id . '</div>';
    }
    else {
      $content = "No record with this title <strong>$node_title</strong>";
    }
    $response->addCommand(new OpenModalDialogCommand($title, $content, $options));    
    return $response;
  }
}
