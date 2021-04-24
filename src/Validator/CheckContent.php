<?php

//https://symfony.com/doc/4.4/validation/custom_constraint.html
namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckContent extends Constraint
{
    public $message = '"{{ string }}" contains an inappropriate word: "{{ word }}"';
}