<?php

/*
 * Sipos custom mail logger
 */

namespace Drupal\sipos_hello\Logger;

use Drupal\Core\Logger\RfcLoggerTrait;
use Drupal\Core\Logger\RfcLogLevel;
use Psr\Log\LoggerInterface;
use Drupal\Core\Logger\LogMessageParserInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Component\Render\FormattableMarkup;

/**
 * SiposMailLogger sends mail when log type is "error"
 *
 * @author jvanbiervliet
 */
class SiposMailLogger implements LoggerInterface {

  use RfcLoggerTrait;

  /**
   * @var \Drupal\Core\Logger\LogMessageParserInterface
   */
  protected $parser;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * MailLogger constructor.
   *
   * @param \Drupal\Core\Logger\LogMessageParserInterface $parser
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(LogMessageParserInterface $parser, ConfigFactoryInterface $config_factory) {
    $this->parser = $parser;
    $this->configFactory = $config_factory;
  }

  public function alert($message, array $context = array()): void {
    
  }

  public function critical($message, array $context = array()): void {
    
  }

  public function debug($message, array $context = array()): void {
    
  }

  public function emergency($message, array $context = array()): void {
    
  }

  public function error($message, array $context = array()): void {
    
  }

  public function info($message, array $context = array()): void {
    
  }

  /*
   * {@inheritdoc}
   */

  public function log($level, $message, array $context = array()): void {
    if ($level !== RfcLogLevel::ERROR) {
      return;
    }
    $to = $this->configFactory->get('system.site')->get('mail');
    $langcode = $this->configFactory->get('system.site')->get('langcode');
    $variables = $this->parser->parseMessagePlaceholders($message, $context);
    $markup = new FormattableMarkup($message, $variables);
    // ->mail parameters:
    //    sipos_hello: module we want to use for mailing
    //    sipos_hello_log: the key (~= template), defined in hook_mail()
    //    ['message' => $markup]: $params array, encountered in hook_mail()
    \Drupal::service('plugin.manager.mail')->mail('sipos_hello', 'sipos_hello_log', $to, $langcode, ['message' => $markup]);
  }

  public function notice($message, array $context = array()): void {
    
  }

  public function warning($message, array $context = array()): void {
    
  }

}
