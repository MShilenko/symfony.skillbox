<?php

namespace App\Homework;

interface RegistrationSpamFilterInterface
{
    public function filter(string $email): bool;
}