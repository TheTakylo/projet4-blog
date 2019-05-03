<?php

class Assets
{

    static function css(string $file): string
    {
        return SITE_URL . "/css/{$file}";
    }

    static function js(string $file): string
    {
        return SITE_URL . "/js/{$file}";
    }

    static function img(string $file): string
    {
        return SITE_URL . "/images/{$file}";
    }

}
