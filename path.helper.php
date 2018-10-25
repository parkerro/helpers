<?php
/**
*	Path Helper
*	@author ParkerRo 2018
*/
class PathHelper{

    /**
     * Path Traversal 防堵
     * realPath( {base path}, {須檢查的path} )
     */
    public function realPath ($basePath, $path) {
        $realPath = realpath( $path );
        if ($realPath === false || strpos($realPath, $basePath) !== 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkUpperLevel ($path) {
        if(preg_match('/..\//', $path)) {
            return false;
        } else {
            return true;
        }
    }
}