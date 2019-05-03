<?php


class Text
{

    static function truncate(string $text, $limit = 150): string
    {
        if(strlen($text) > $limit) {
            $text = $text.' ';
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text ,' '));

            $text .= '...';
        }

        return $text;
    }


}