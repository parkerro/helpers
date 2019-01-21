<?php
/**
*	stringHelper
*	@author ParkerRo 2018
*/
class stringHelper{

    public static function SQLReplace($string) {
        //$string = strtoupper($string);

        $injectionWords = array(
            '\'',
            '"',
            '"',
            '-',
            '#',
            '`',
            '\\',
            '0x02bc',
            'SELECT',
            'DELETE',
            'DROP'
        );

        return str_replace($injectionWords, '', $string);
    }

    public static function makeClickableLinks($url) {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $url);
    }
}
