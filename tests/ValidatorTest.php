<?php namespace Tests;

use Carbon\Carbon;
use Anekdotes\Validator;
use PHPUnit_Framework_TestCase;

class ValidatorTest extends PHPUnit_Framework_TestCase
{

    public function testIfValidatorCanBeCreated()
    {
        $a = new Validator();
        $this->assertNotEmpty($a, "Validator empty");
    }

    public function testIfCanMake()
    {
        $a = Validator::make(array(),array());
        $this->assertNotEmpty($a, "Validator make empty");
    }

}
