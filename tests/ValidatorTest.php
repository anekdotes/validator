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

  public function testRequiredWithoutFail()
  {
    $rules = array('test2' => array('requiredWithout:test1'));
    $input = array(
      'test1' => '',
      'test2' => ''
    );
    $v = Validator::make($input, $rules);
    $this->assertTrue($v->fail());
  }

  public function testRequiredWithoutSuccess()
  {
    $rules = array('test2' => array('requiredWithout:test1'));
    $input = array(
      'test1' => '',
      'test2' => 'test'
    );
    $v = Validator::make($input, $rules);
    $this->assertFalse($v->fail());
  }

  public function testIntegerFail()
  {
    $rules = array('test' => array('integer'));
    $input = array('test' => 'a');
    $v = Validator::make($input, $rules);
    $this->assertTrue($v->fail());
  }

  public function testIntegerSuccess()
  {
    $rules = array('test' => array('integer'));
    $input = array('test' => 1);
    $v = Validator::make($input, $rules);
    $this->assertFalse($v->fail());
  }

  public function testNumericFail()
  {
    $rules = array('test' => array('numeric'));
    $input = array('test' => 'a');
    $v = Validator::make($input, $rules);
    $this->assertTrue($v->fail());
  }

  public function testNumericSuccess()
  {
    $rules = array('test' => array('numeric'));
    $input = array('test' => 1);
    $v = Validator::make($input, $rules);
    $this->assertFalse($v->fail());
  }
/*
  public function testDateFail()
  {
    $rules = array(
      'test1' => array('date'),
      'test2' => array('date')
    );
    $input = array(
      'test1' => '01-01-2000',
      'test2' => '01/01/2000'
    );
    $v = Validator::make($input, $rules);
    $this->assertTrue($v->fail());
  }

  public function testDateSuccess()
  {
    $rules = array(
      'test1' => array('date'),
      'test2' => array('date')
    );
    $input = array(
      'test1' => '01-01-2000',
      'test2' => '01/01/2000'
    );
    $v = Validator::make($input, $rules);
    $this->assertFalse($v->fail());
  }
*/
}
