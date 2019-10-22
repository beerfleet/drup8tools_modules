<?php

/*
 * Sipos custom mail logger
 */

namespace Drupal\sipos_hello\Logger;

use Drupal\Core\Logger\RfcLoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * SiposMailLogger sends mail when log type is "error"
 *
 * @author jvanbiervliet
 */
class SiposMailLogger implements LoggerInterface {

  use RfcLoggerTrait;

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

  public function log($level, $message, array $context = array()): void {
    
  }

  public function notice($message, array $context = array()): void {
    
  }

  public function warning($message, array $context = array()): void {
    
  }

}
