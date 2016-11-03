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
        $input = ['test1' => ''];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
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
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
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
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testMinimumFail()
    {
        $rules = ['test1' => ['minimum:2']];
        $input = ['test1' => ''];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['minimum:2']];
        $input = ['test1' => 1];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['minimum:6']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['minimum:10']];
        $input = ['test1' => [
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testMinimumSuccess()
    {
        $rules = ['test1' => ['minimum:2']];
        $input = ['test1' => 3];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['minimum:3']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['minimum:2']];
        $input = ['test1' => [
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testMaximumFail()
    {
        $rules = ['test1' => ['maximum:2']];
        $input = ['test1' => ''];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['maximum:2']];
        $input = ['test1' => 3];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['maximum:3']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['maximum:2']];
        $input = ['test1' => [
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testMaximumSuccess()
    {
        $rules = ['test1' => ['maximum:2']];
        $input = ['test1' => 1];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['maximum:5']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['maximum:10']];
        $input = ['test1' => [
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testSizeFail()
    {
        $rules = ['test1' => ['size:2']];
        $input = ['test1' => ''];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['size:2']];
        $input = ['test1' => 3];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['size:3']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
        $rules = ['test1' => ['size:2']];
        $input = ['test1' => [
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
          'error'    => 0,
          'size'     => 7734,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testSizeSuccess()
    {
        $rules = ['test1' => ['size:2']];
        $input = ['test1' => 2];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['size:5']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
        $rules = ['test1' => ['size:7']];
        $input = ['test1' => [
          'name'     => 'pdf-test.pdf',
          'type'     => 'application/pdf',
          'tmp_name' => './Tests/files/pdf-test.pdf',
          'error'    => 0,
          'size'     => 7168,
        ]];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testLengthFail()
    {
        $rules = ['test1' => ['length:5']];
        $input = ['test1' => 'hi'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testLengthSuccess()
    {
        $rules = ['test1' => ['length:5']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testUrlFail()
    {
        $rules = ['test1' => ['url']];
        $input = ['test1' => 'hello'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testUrlSuccess()
    {
        $rules = ['test1' => ['url']];
        $input = ['test1' => 'http://www.anekdotes.com'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testValidDomainFail()
    {
        $rules = ['test1' => ['ValidDomain']];
        $input = ['test1' => 'http://www.asdfasdfasdfasdf.com'];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testValidDomainSuccess()
    {
        $rules = ['test1' => ['ValidDomain']];
        $input = ['test1' => 'anekdotes.com'];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testSameFail()
    {
        $rules = ['test1' => ['same:test2']];
        $input = [
            'test1' => 'hello',
            'test2' => 'hi',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testSameSuccess()
    {
        $rules = ['test1' => ['same:test2']];
        $input = [
            'test1' => 'hello',
            'test2' => 'hello',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testConfirmedFail()
    {
        $rules = ['test1' => ['confirmed']];
        $input = [
            'test1'              => 'hello',
            'test1_confirmation' => 'hi',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testConfirmedSuccess()
    {
        $rules = ['test1' => ['confirmed']];
        $input = [
            'test1'              => 'hello',
            'test1_confirmation' => 'hello',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testAlphaFailWithNumber()
    {
        $rules = ['test1' => ['alpha']];
        $input = [
            'test1' => 'hello1',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testAlphaFailWithNonalphanum()
    {
        $rules = ['test1' => ['alpha']];
        $input = [
            'test1' => '!@#$%?',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testAlphaNumFail()
    {
        $rules = ['test1' => ['alpha_num']];
        $input = [
            'test1' => '!@#$%?',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testAlphaDashFail()
    {
        $rules = ['test1' => ['alpha_dash']];
        $input = [
            'test1' => '!@#$%?',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testAlphaSuccess()
    {
        $rules = ['test1' => ['alpha']];
        $input = [
            'test1' => 'hello',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testAlphanumSuccess()
    {
        $rules = ['test1' => ['alpha_num']];
        $input = [
            'test1' => 'hello123',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testAlphaDashSuccess()
    {
        $rules = ['test1' => ['alpha_dash']];
        $input = [
            'test1' => 'hello-123',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testAfterFail()
    {
        $rules = ['test1' => ['after:2012-11-14']];
        $input = [
            'test1' => '2011-10-13',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testAfterSuccess()
    {
        $rules = ['test1' => ['after:2012-11-14']];
        $input = [
            'test1' => '2014-10-13',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testAfterInvalidFirstDate()
    {
        $rules = ['test1' => ['after:abc']];
        $input = [
            'test1' => '2014-10-13',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testAfterInvalidSecondDate()
    {
        $rules = ['test1' => ['after:2012-11-14']];
        $input = [
            'test1' => 'abc',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testBeforeSuccess()
    {
        $rules = ['test1' => ['before:2012-11-14']];
        $input = [
            'test1' => '2011-10-13',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testBeforeFail()
    {
        $rules = ['test1' => ['before:2012-11-14']];
        $input = [
            'test1' => '2014-10-13',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testBeforeInvalidFirstDate()
    {
        $rules = ['test1' => ['before:abc']];
        $input = [
            'test1' => '2014-10-13',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testBeforeInvalidSecondDate()
    {
        $rules = ['test1' => ['before:2012-11-14']];
        $input = [
            'test1' => 'abc',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDigitsSuccess()
    {
        $rules = ['test1' => ['digits:4']];
        $input = [
            'test1' => '1234',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testDigitsFail()
    {
        $rules = ['test1' => ['digits:14']];
        $input = [
            'test1' => '2014',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDigitsInvalidFirstNumber()
    {
        $rules = ['test1' => ['digits:abc']];
        $input = [
            'test1' => '2014',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDigitsInvalidSecondNumber()
    {
        $rules = ['test1' => ['digits:1']];
        $input = [
            'test1' => 'a',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDigitsBetweenSuccess()
    {
        $rules = ['test1' => ['digits_between:4,6']];
        $input = [
            'test1' => '1234',
        ];
        $v = Validator::make($input, $rules);
        $this->assertFalse($v->fail());
    }

    public function testDigitsBetweenFail()
    {
        $rules = ['test1' => ['digits_between:4,6']];
        $input = [
            'test1' => '201',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDigitsBetweenInvalidFirstNumber()
    {
        $rules = ['test1' => ['digits_between:abc,1']];
        $input = [
            'test1' => '2014',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDigitsBetweenInvalidSecondNumber()
    {
        $rules = ['test1' => ['digits_between:1,abc']];
        $input = [
            'test1' => '2014',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }

    public function testDigitsBetweenInvalidThirdNumber()
    {
        $rules = ['test1' => ['digits_between:1,2']];
        $input = [
            'test1' => 'a',
        ];
        $v = Validator::make($input, $rules);
        $this->assertTrue($v->fail());
    }
}
