<?php

namespace App\Validator;

use App\Homework\RegistrationSpamFilterInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RegistrationSpamValidator extends ConstraintValidator
{
    /**
     * @var RegistrationSpamFilterInterface $registrationSpamFilter
     */
    private $registrationSpamFilter;

    public function __construct(RegistrationSpamFilterInterface $registrationSpamFilter)
    {
        $this->registrationSpamFilter = $registrationSpamFilter;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\RegistrationSpam */

        if (null === $value || '' === $value) {
            return;
        }

        if (!$this->registrationSpamFilter->filter($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
