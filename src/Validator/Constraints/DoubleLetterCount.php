<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class DoubleLetterCount extends Constraint
{
public string $message = 'The value "{{ value }}" does not contain each letter twice.';
}
