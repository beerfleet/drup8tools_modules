<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;

/**
 * Provides a user details block.
 *
 * @Block(
 *  id = "hello_block",
 *  admin_label = @Translation("Hello Drupal 8 !")
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return array(
      '#markup' => $this->_populate_markup(),
    );
  }

  private function _populate_markup() {
    /* @var $user User */
    $user = User::load(\Drupal::currentUser()->id());

    if ($user->get('uid')->value < 1) {
      return t('Welcome Visitor! The current time is ' . date('d-m-Y h:i:s', time()));
    }
    else {
      $user_info = 'User name: ' . $user->getUsername() . "<br/>";
      $user_info .= 'Language: ' . $user->getPreferredLangcode() . "<br/>";
      $user_info .= 'Email: ' . $user->getEmail() . "<br/>";
      $user_info .= 'Timezone: ' . $user->getTimeZone() . "<br/>";
      $user_info .= 'Created: ' . date('d-m-Y h:i:s', $user->getCreatedTime()) . "<br/>";
      $user_info .= 'Updated: ' . date('d-m-Y h:i:s', $user->getChangedTime()) . "<br/>";
      $user_info .= 'Last Login: ' . date('d-m-Y h:i:s', $user->getLastLoginTime()) . "<br/>";

      $roles = NULL;

      foreach ($user->getRoles() as $role) {
        $roles .= $role . ",";
      }

      $roles = 'Roles: ' . rtrim($roles, ',');

      $user_info .= $roles;

      return $user_info;
    }
  }

}
