<?php

namespace Framework\Helpers;

class TextHelper
{

    static function slug(string $text): string
    {
        $slugify = strtolower($text);
        $slugify = iconv('UTF-8', 'ASCII//TRANSLIT', $slugify);
        $slugify = preg_replace("/[^a-zA-Z0-9\/]/", "-", $slugify);
        $slugify = preg_replace("/[-]{2,}/", "-", $slugify);

        return trim($slugify, '-');
    }
}