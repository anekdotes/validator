<?php

/*
 * This file is part of the Validator package.
 *
 * (c) Anekdotes Communication inc. <info@anekdotes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

use Anekdotes\Validator;
use PHPUnit_Framework_TestCase;

class ValidatorTest extends PHPUnit_Framework_TestCase
{

  public function testIfValidatorCanBeCreated()
  {
    $v = new Validator();
    $this->assertInstanceOf('Anekdotes\Validator', $v, "Validator not instance of 'Anekdotes\Validator'");
  }

  public function testIfCanMake()
  {
    $v = Validator::make(array(),array());
    $this->assertInstanceOf('Anekdotes\Validator', $v, "Validator::make not instance of 'Anekdotes\Validator'");
  }

  public function testIsRequiredFail()
  {
    $rules = array('test' => array('required'));
    $input = array('test' => '');
    $v = Validator::make($input, $rules);
    $this->assertTrue($v->fail());
  }

  public function testIsRequiredSuccess()
  {
    $rules = array('test' => array('required'));
    $input = array('test' => 'test');
    $v = Validator::make($input, $rules);
    $this->assertFalse($v->fail());
  }

  public function testRequiredIfFail()
  {
    $rules = array('test2' => array('requiredIf:test1,test'));
    $input = array(
      'test1' => 'test',
      'test2' => ''
    );
    $v = Validator::make($input, $rules);
    $this->assertTrue($v->fail());
  }

  public function testRequiredIfSuccess()
  {
    $rules = array('test2' => array('requiredIf:test1,test'));
    $input = array(
      'test1' => 'test',
      'test2' => 'test'
    );
    $v = Validator::make($input, $rules);
    $this->assertFalse($v->fail());
  }

  public function testRequiredWithFail()
  {
    $rules = array('test2' => array('requiredWith:test1'));
    $input = array(
      'test1' => 'test',
      'test2' => ''
    );
    $v = Validator::make($input, $rules);
    $this->assertTrue($v->fail());
  }

  public function testRequiredWithSuccess()
  {
    $rules = array('test2' => array('requiredWith:test1'));
    $input = array(
      'test1' => 'test',
      'test2' => 'test'
    );
    $v = Validator::make($input, $rules);
    $this->assertFalse($v->fail());
  }

}
