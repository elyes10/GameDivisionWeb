<?php


namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class CheckContentValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof CheckContent) {
            throw new UnexpectedTypeException($constraint, CheckContent::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'string');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        // list of words to check
        $words = array("test ", "test1");
        foreach ($words as $word){
            if(strpos($value, $word) !== false){
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', $value)
                    ->setParameter('{{ word }}', $word)
                    ->addViolation();
                break;
            }
        }
    }
}