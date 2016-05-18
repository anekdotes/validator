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
        $v = Validator::make([], []);
        $this->assertInstanceOf('Anekdotes\Validator', $v, "Validator::make not instance of 'Anekdotes\Validator'");
    }

    public function testIsRequiredStringFail()
    {
        $rules = ['test' => ['required']];
        $input = ['test' => ''];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testIsRequiredStringSuccess()
    {
        $rules = ['test' => ['required']];
        $input = ['test' => 'test'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testIsRequiredArrayFail()
    {
        $rules = ['test' => ['required']];
        $input = ['test' => []];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testIsRequiredArraySuccess()
    {
        $rules = ['test' => ['required']];
        $input = ['test' => ['test']];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testRequiredIfFail()
    {
        $rules = ['test2' => ['requiredIf:test1,test']];
        $input = [
            'test1' => 'test',
            'test2' => '',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testRequiredIfSuccess()
    {
        $rules = ['test2' => ['requiredIf:test1,test']];
        $input = [
            'test1' => 'test',
            'test2' => 'test',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testRequiredWithFail()
    {
        $rules = ['test2' => ['requiredWith:test1']];
        $input = [
            'test1' => 'test',
            'test2' => '',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testRequiredWithSuccess()
    {
        $rules = ['test2' => ['requiredWith:test1']];
        $input = [
            'test1' => 'test',
            'test2' => 'test',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testRequiredWithoutFail()
    {
        $rules = ['test2' => ['requiredWithout:test1']];
        $input = [
            'test1' => '',
            'test2' => '',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testRequiredWithoutSuccess()
    {
        $rules = ['test2' => ['requiredWithout:test1']];
        $input = [
            'test1' => '',
            'test2' => 'test',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testIntegerFail()
    {
        $rules = ['test' => ['integer']];
        $input = ['test' => 'a'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testIntegerSuccess()
    {
        $rules = ['test' => ['integer']];
        $input = ['test' => 1];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testNumericFail()
    {
        $rules = ['test' => ['numeric']];
        $input = ['test' => 'a'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testNumericSuccess()
    {
        $rules = ['test' => ['numeric']];
        $input = ['test' => 1];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testDateStringFail()
    {
        $rules = ['test1' => ['date']];
        $input = ['test1' => 'test'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDateStringSuccess()
    {
        $rules = ['test1' => ['date']];
        $input = ['test1' => '1-1-2000'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testDifferentFail()
    {
        $rules = ['test1' => ['different:allo']];
        $input = ['test1' => 'allo'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDifferentSuccess()
    {
        $rules = ['test1' => ['different:salut']];
        $input = ['test1' => 'allo'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testEmailFail()
    {
        $rules = ['test1' => ['email']];
        $input = ['test1' => 'allo'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testEmailSuccess()
    {
        $rules = ['test1' => ['email']];
        $input = ['test1' => 'test@test.com'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testPostalCodeFail()
    {
        $rules = ['test1' => ['postalCode']];
        $input = ['test1' => 'allo'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testPostalCodeSuccess()
    {
        $rules = ['test1' => ['postalCode']];
        $input = ['test1' => 'J4J4W4'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testPhoneNumberFail()
    {
        $rules = ['test1' => ['phoneNumber']];
        $input = ['test1' => '121'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testPhoneNumberSuccess()
    {
        $rules = ['test1' => ['phoneNumber']];
        $input = ['test1' => '123-123-1234'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testBetweenFail()
    {
        $rules = ['test1' => ['between:1,3']];
        $input = ['test1' => 1];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['between:1,3']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['between:1,6']];
        $input = ['test1' => [
          'name'     => 'test.png',
          'type'     => 'image/png',
          'tmp_name' => '/test/files/test.png',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testBetweenSuccess()
    {
        $rules = ['test1' => ['between:1,3']];
        $input = ['test1' => 2];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['between:1,3']];
        $input = ['test1' => 'hi'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['between:4,8']];
        $input = ['test1' => [
          'name'     => 'test.png',
          'type'     => 'image/png',
          'tmp_name' => '/test/files/test.png',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

}
