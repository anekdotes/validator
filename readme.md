# Anekdotes Validator #

[![Latest Stable Version](https://poser.pugx.org/anekdotes/validator/v/stable)](https://packagist.org/packages/anekdotes/validator)
[![Build Status](https://travis-ci.org/anekdotes/validator.svg?branch=master)](https://travis-ci.org/anekdotes/validator)
[![codecov.io](https://codecov.io/github/anekdotes/validator/coverage.svg?branch=master)](https://codecov.io/github/anekdotes/validator?branch=master)
[![StyleCI](https://styleci.io/repos/53698668/shield?style=flat)](https://styleci.io/repos/53698668)
[![License](https://poser.pugx.org/anekdotes/validator/license)](https://packagist.org/packages/anekdotes/validator)
[![Total Downloads](https://poser.pugx.org/anekdotes/validator/downloads)](https://packagist.org/packages/anekdotes/validator)


---

A validator class to validate input data against validation types.

## Installation

Install via composer in your project : 

    composer require anekdotes/validator

## Basic usage

Prepare an input array to validate and a rules array to validate against

```php
  $input = [
    "formName" => $_POST["formName"],
    "formEmail" => $_POST["formEmail"],
    "otherData" => "Bob"
  ];

  $rules = [
    "formName" => ["required"],
    "formEmail" => ["required", "email"]
  ]
```

Then, instantiate the validator with the rules and use its status to follow-up with code.
```php
// initiate the Validator with inputs and rules
use Anekdotes\Validator;
function doSomething(){
    $validator = Validator::make($inputs, $rules);

    // test if validator pass all the tests
    if($validator->fail()) {
        //Log something maybe?
        //Display a message maybe?
        return false;
	  }
    
    //Proceed with the data
    //Store it in the db?

}
```

## Rule Types

#### required

Check if the input is empty

```php
  $rules = ["inputField" => "required"];

  //The following inputs would validate as a failure
  $inputA = ["inputField" : "" ];
  $inputB = ["otherInput" : "Whatever" ];

  //The following inputs would validate as a success
  $inputC = ["inputField" : "Something" ];
  $inputD = ["inputField" : "Stuff" , "otherInput" : "anythingElse"];
```

#### requiredIf

Check if the input is empty, but only if an other input's value equals a specific value

```php
  $rules = ["inputField" => "requiredIf:otherInput,otherInputsValue"];

  //The following inputs would validate as a failure
  $inputA = ["inputField" : "" , "otherInput" : "otherInputsValue"];

  //The following inputs would validate as a success
  $inputB = ["inputField" : "" , "otherInput" : "anythingElse"];
  $inputC = ["inputField" : ""];
  $inputD = ["inputField" : "Data" , "otherInput" : "otherInputsValue"];
  $inputE = ["inputField" : "Data" , "otherInput" : ""];
```

#### requiredWith

Check if the input is empty if an other input is not empty

```php

  $rules = ["inputField" => "requiredWith:otherInput"];

  //The following inputs would validate as a failure
  $inputA = ["inputField" : "" , "otherInput" : "otherInputsValue"];
  $inputB = ["inputField" : "" , "otherInput" : "anythingElse"];

  //The following inputs would validate as a success
  $inputC = ["inputField" : ""];
  $inputD = ["inputField" : "Data" , "otherInput" : "otherInputsValue"];
  $inputE = ["inputField" : "Data" , "otherInput" : ""];
```

#### requiredWithout

Check if the input is empty if an other input is empty

```php

  $rules = ["inputField" => "requiredWithout:otherInput"];

  //The following inputs would validate as a failure
  $inputC = ["inputField" : ""];

  //The following inputs would validate as a success
  $inputA = ["inputField" : "" , "otherInput" : "otherInputsValue"];
  $inputB = ["inputField" : "" , "otherInput" : "anythingElse"];
  $inputD = ["inputField" : "Data" , "otherInput" : "otherInputsValue"];
  $inputE = ["inputField" : "Data" , "otherInput" : ""];
```

#### integer

Check if the input is an integer

```php

  $rules = ["inputField" => "integer"];

  //The following inputs would validate as a failure
  $inputA = ["inputField" : "a"];
  $inputB = ["inputField" : "12"];
  $inputC = ["inputField" : 12.3];

  //The following inputs would validate as a success
  $inputD = ["inputField" : 1];

```

#### numeric

Check if the input is numeric

```php

  $rules = ["inputField" => "numeric"];

  //The following inputs would validate as a failure
  $inputA = ["inputField" : "a"];

  //The following inputs would validate as a success
  $inputB = ["inputField" : "12"];
  $inputC = ["inputField" : 12.3];
  $inputD = ["inputField" : 1];

```

#### date

Check if the input is a date

```php

  $rules = ["inputField" => "date"];

  //The following inputs would validate as a failure
  $inputA = ["inputField" : "a"];

  //The following inputs would validate as a success
  $inputB = ["inputField" : "1-1-2000"];

```

#### different

Check if the input is different from compared values

	array('input' => array('different:value_1,value_2,value_n'))

#### email

Check if the input match an email

	array('input' => array('email'))

#### postalCode

Check if the input match a canadian postal code

	array('input' => array('postalCode'))

#### phoneNumber

Check if the input match an american phone number

	array('input' => array('phoneNumber'))

#### between

Check if the input is between a minimum and a maximum

	array('input' => array('between:minimum,maximum'))

You can input

- string : test string length
- number : test number size
- file : test file size in kilobytes

#### minimum

Check if the input is under a minimum

	array('input' => array('minimum:integer'))

You can input

- string : test string length
- number : test number size
- file : test file size in kilobytes

#### maximum

Check if the input is over a maximum

	array('input' => array('maximum:integer'))

You can input

- string : test string length
- number : test number size
- file : test file size in kilobytes

#### size

Check if the input has the exact size

	array('input' => array('size:integer'))

You can input

- string : test string length
- number : test number size
- file : test file size in kilobytes

#### length

Check if the input has the exact length

	array('input' => array('length:integer'))

#### url

Check if the input match an URL

	array('input' => array('url'));

#### validUrl

Check if the input match an URL that is valid

	array('input' => array('validUrl'));

#### same

Check if confirmed value is the same

	array('input' => array('same:input_name'));

#### alpha

Check if the input contains only alphabetic characters

	array('input' => array('alpha'));

#### alpha_num

Check if the input contains only alphabetic and numeric characters

	array('input' => array('alpha_num'));

#### alpha_dash

Check if the input contains only alphabetic,numeric and dashes characters

	array('input' => array('alpha_dash'));

#### before

Check if the input if a date older than the provided :date

    array('input' => array('before:yyyy-mm-dd'));

#### after

Check if the input if a date younger than the provided :date

    array('input' => array('after:yyyy-mm-dd'));

#### digits

Check if the input contains exactly x digits

    array('input' => array('digits:x'));

#### digits_between

Check if the input contains between x and y digits

    array('input' => array('digits_between:x,y'));

#### confirmed

Check if the input_confirmation value is the same then the input

	array('input' => array('confirmed'));
