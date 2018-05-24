<?php
/**
*	youtube helper
*	@author ParkerRo 2018
*/
class youtubeHelper{

    public function getThumbnail($youtubeID){
        return 'https://img.youtube.com/vi/'.$youtubeID.'/0.jpg';
    }

/**
 * getThumbnailByEmbed({html內文})
 * 找尋整串內文中是否有Youtube embed，取得縮圖網址
*/
    public function getThumbnailByEmbed($content){
        if(!$content) return false;

        #判斷內文中有無youtube embed
        if(preg_match('/www.youtube.com\/embed\/([^"]+)/', $content, $match)){
            if($match[1]){
                return $this->getThumbnail($match[1]);
            }
        }
    }
}