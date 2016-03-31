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
        $rules = [
            'test1' => ['date'],
        ];
        $input = [
            'test1' => 'test',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDateStringSuccess()
    {
        $rules = [
            'test1' => ['date'],
        ];
        $input = [
            'test1' => '1-1-2000',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testDateDateTimeSuccess()
    {
        $rules = [
            'test1' => ['date'],
        ];
        $input = [
            'test1' => new Date,
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }
}
