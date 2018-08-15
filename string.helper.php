<?php
/**
*	stringHelper
*	@author ParkerRo 2018
*/
class stringHelper{

    public static function SQLReplace($string) {
        $string = strtoupper($string);

        $injectionWords = array(
            '\'',
            '"',
            '"',
            '-',
            '#',
            '`',
            '\\',
            '/'
            '0x02bc',
            'SELECT',
            'DELETE',
            'DROP'
        );

        return str_replace($injectionWords, '', $string);
    }
}
