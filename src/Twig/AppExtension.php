<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Twig\AppUploadedAsset;
use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array 
    {
        return [
            new TwigFunction('uploaded_asset', [AppUploadedAsset::class, 'asset'])
        ];
    }


    public function getFilters(): array
    {
        return [
            new TwigFilter('ago', [AppRuntime::class, 'getDiff']),
            new TwigFilter('cached_markdown', [AppRuntime::class, 'parseMarkdown'], ['is_safe' => ['html']]),
        ];
    }
}

