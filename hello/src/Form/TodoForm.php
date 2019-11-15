<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Description of TodoForm
 *
 * @author jvanbiervliet
 */
class TodoForm extends FormBase {
  
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['groep_planning'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Planning'),
    ];
    
    $form['groep_gegevens'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Gegevens'),
    ];
    
    $form['groep_planning']['todo_date'] = [
      '#type' => 'date',
      '#title' => $this->t('Einddatum'),
      '#description' => $this->t('Einddatum voor de todo'),
      '#default_value' => date('Y-m-d'),
    ];
    
    $form['groep_gegevens']['todo_titel'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Titel'),
      '#description' => $this->t('todo titel'),
    ];
    
    $form['groep_gegevens']['todo_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Taakomschrijving'),
      '#resizable' => 'both',
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

  public function getFormId(): string {
    return 'hello_todo';
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $datum = $form_state->getValue('todo_date');
    drupal_set_message($this->t('The date is %datum', ['%datum' => $datum]));
  }

}
