<?php
/**
*   @author ParkerRo
*   使用google api 取得網頁縮圖
*   
*   echo screenshotHelper::getImg('http://www.pchome.com.tw/');
*/
class screenshotHelper{

    const google_api = "https://www.googleapis.com/pagespeedonline/v1/runPagespeed";
    static private $siteUrl;


/**
*   getImg({要輸出縮圖的網址}, {img 或是 base64})
*
*/
    public static function getImg($site_url, $type = 'base64')
    {
        self::$siteUrl = $site_url;
        if(!self::$siteUrl || self::$siteUrl == null) return false;

        try{
            $img_data = self::getImgData();

            // 選擇輸出樣式 img || base64
            switch ($type) {
                case 'base64':
                    $return = $img_data;
                    break;
                case 'img':
                    $return = "<img src=\"data:image/jpeg;base64,".$img_data."\" />";
                    break;           
                default:
                    $return = $img_data;
                    break;   
            }

            return $return;
        }
        catch(Exception $e){
            return 'Error message: ' .$e->getMessage();
        }
    }


/**
*   getImgData
*   取得google api 資料
*/
    private static function getImgData()
    {

        $url = self::google_api . "?screenshot=true&url=" . self::$siteUrl;

        $req = @file_get_contents($url);
        if(!$req){
            throw new Exception("url error");
        }

        $req_json = json_decode($req,true);
        $screenshot = $req_json['screenshot']['data'];
        $screenshot = str_replace(array('_','-'),array('/','+'),$screenshot); 
        return $screenshot;
    }
}


