<?php

use App\Services\AutoTranslator;

if (! function_exists('t')) {
    function t(string $text): string
    {
        return AutoTranslator::translate($text);
    }
}