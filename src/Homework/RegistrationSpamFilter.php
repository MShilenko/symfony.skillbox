<?php

namespace App\Homework;

class RegistrationSpamFilter implements RegistrationSpamFilterInterface
{
    private const DOMAIN_ZONE_LIST = ['.ru', '.com', '.org'];

    public function filter(string $email): bool 
    {
        $dzPattern = '#' . implode('|', self::DOMAIN_ZONE_LIST) . '$#';

        return (bool) !preg_match($dzPattern, $email);
    }
}