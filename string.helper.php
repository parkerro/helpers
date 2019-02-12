<?php
/**
*	stringHelper
*	@author ParkerRo 2018
*/
class stringHelper{

    /**
     * SQL 安全性基本過濾
     */
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

    /**
     * 內文 URL 直接轉換成可點擊的 <a> tags
     */
    public static function makeClickableLinks($url) {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $url);
    }

    /**
     * emoji 去除工具
     */
    public static function removeEmojis($string) {

        // Match Emoticons
        $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clear_string = preg_replace($regex_emoticons, '', $string);

        // Match Miscellaneous Symbols and Pictographs
        $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clear_string = preg_replace($regex_symbols, '', $clear_string);

        // Match Transport And Map Symbols
        $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clear_string = preg_replace($regex_transport, '', $clear_string);

        // Match Miscellaneous Symbols
        $regex_misc = '/[\x{2600}-\x{26FF}]/u';
        $clear_string = preg_replace($regex_misc, '', $clear_string);

        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
        $clear_string = preg_replace($regex_dingbats, '', $clear_string);

        return $clear_string;
    }
}
