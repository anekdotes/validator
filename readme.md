# Anekdotes Validator #

[![Latest Stable Version](https://poser.pugx.org/anekdotes/validator/v/stable)](https://packagist.org/packages/anekdotes/validator)
[![Build Status](https://travis-ci.org/anekdotes/validator.svg?branch=master)](https://travis-ci.org/anekdotes/validator)
[![License](https://poser.pugx.org/anekdotes/validator/license)](https://packagist.org/packages/anekdotes/validator)
[![Total Downloads](https://poser.pugx.org/anekdotes/validator/downloads)](https://packagist.org/packages/anekdotes/validator)
[![codecov.io](https://codecov.io/github/anekdotes/validator/coverage.svg?branch=master)](https://codecov.io/github/anekdotes/validator?branch=master)
[![StyleCI](https://styleci.io/repos/53698668/shield?style=flat)](https://styleci.io/repos/53698668)

---

A validator class to validate any type of input against any type of validation.

	// initate the Validator with inputs and rules
	$validator = Validator::make($inputs, $rules);

	// test if validator pass all the tests
	if($validator->fail()) {
		// return with $validator->errors, an array of all error messages
	}
	else {
		// do your stuff
	}

`$inputs` must be an array of all your input and `$rules` must be an array of all the rules :

	$rules = array(
		'name' => array('required'),
		'email' => array('required', 'email'),
		'age' => array('integer')
	)

#### required

Check if the input is empty

	array('input' => array('required'))

#### requiredIf

Check if the input is empty if an other input has a conditionnal value

	array('input' => array('requiredIf:other_input,conditionnal_value'))

#### requiredWith

Check if the input is empty if an other input is not empty

	array('input' => array('requiredWith:other_input'))

#### requiredWithout

Check if the input is empty if an other input is empty

	array('input' => array('requiredWithout:other_input'))

#### integer

Check if the input is integer

	array('input' => array('integer'))

#### numeric

Check if the input is numeric

	array('input' => array('numeric'))

#### date

Check if the input is a date

	array('input' => array('date'))

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



#### confirmed

Check if the input_confirmation value is the same then the input

	array('input' => array('confirmed'));
