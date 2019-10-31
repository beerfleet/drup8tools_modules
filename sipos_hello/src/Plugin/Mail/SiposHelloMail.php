<?php

namespace Drupal\sipos_hello\Plugin\Mail;

use Drupal\Core\Mail\MailFormatHelper;
use Drupal\Core\Mail\MailInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the Sipos Hello mail backend.
 * @Mail(
 *  id = "sipos_hello_mail",
 *  label = @Translation("Sends mail using an external API specific to our Sipos Hello module.")
 * )
 *
 * @author jvanbiervliet
 */
class SiposHelloMail implements MailInterface, ContainerFactoryPluginInterface {
  
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration,
      $plugin_id, $plugin_definition) {
    return new static();
  }
  
  public function format(array $message) {
    // Join the body array into one string.
    $message['body'] = implode("\n\n", $message['body']);
    // Convert any HTML to plain-text.
    $message['body'] = MailFormatHelper::htmlToText($message['body']);
    // Wrap the mail body for sending.
    $message['body'] = MailFormatHelper::wrapMail($message['body']);
    return $message;
  }
  
  public function mail(array $message) {
    // Use the external API to send the email based on the $message array
    // constructed via the `hook_mail()` implementation.
    return $message;
  }

}
