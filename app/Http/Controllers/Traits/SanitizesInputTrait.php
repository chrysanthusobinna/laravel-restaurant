<?php

namespace App\Http\Controllers\Traits;

use HTMLPurifier;
use HTMLPurifier_Config;

trait SanitizesInputTrait
{
    public function sanitizeHtmlContent(string $content): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($content);
    }
}
