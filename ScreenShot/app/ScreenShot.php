<?php
/**
*   @author ParkerRo
*   使用google api 取得網頁縮圖
*   $ScreenShot = new ScreenShot;
*   $ScreenShot->get_img('https://parkerro.tw/');
*/
class ScreenShot{

    public function get_img($site_url = '')
    {
    	$google_api = "https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=".$site_url."&screenshot=true";

    	$return = file_get_contents($google_api);
    	$return = json_decode($return, true);

        if(@$return['error']){
            echo "Api error.";
            exit;
        }
        $screenshot = $return['screenshot']['data'];
        $screenshot = str_replace(array('_','-'),array('/','+'),$screenshot); 

        echo "<img src=\"data:image/jpeg;base64,".$screenshot."\" />";
    }
}


