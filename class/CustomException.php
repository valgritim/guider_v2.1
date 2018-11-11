<?php

/**
 * 
 */
class CustomException extends Exception
{

	public function __construct($message, $code = '0001')
  {
    parent::__construct($message, $code);
  }
  
  public function __toString()
  {
    return $this->message;
  }
}