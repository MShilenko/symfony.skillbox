<?php

namespace App\Twig;

use Carbon\Carbon;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CustomDateExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('custom_date', [$this, 'getDiff']),
        ];
    }

    public function getDiff($value)
    {
        return (new Carbon($value))->locale('ru')->diffForHumans();
    }
}
