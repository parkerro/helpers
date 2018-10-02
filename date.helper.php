<?php
/**
*	Datetime helper
*	@author ParkerRo 2018
*/
class dateHelper{

    public $formateDate = "Y-m-d";
    public $formateTime = "H:i:s";

    // 現在時間 2018/01/01 00:00:00
    public function now(){
        return date($this->formateDate." ".$this->formateTime);
    }

    // 今天日期 2018/01/01
    public function today(){
        return date($this->formateDate);
    }

    // 昨天日期
    public function yesterday(){
        return date($this->formateDate, strtotime("-1 days"));
    }    

    // 明天日期
    public function tomorrow(){
        return date($this->formateDate, strtotime("+1 days"));
    }  

    // 七天前日期
    public function oneWeekAgo(){
        return date($this->formateDate, strtotime("-7 days"));
    }  

    // 三十天前日期
    public function oneMonthAgo(){
        return date($this->formateDate, strtotime("-30 days"));
    }
  
    // 該月第一天日期; $date = 指定日期
    public function startOfMonth($date = null){
        $date = ($date)?$date:$this->now(); // 如果沒有參數，使用現在時間
        return date($this->formateDate, strtotime(date('Y-m-01', strtotime($date))));
    } 
    
    // 該月最後一天日期; $date = 指定日期    
    public function endOfMonth($date = null){
        $date = ($date)?$date:$this->now(); // 如果沒有參數，使用現在時間
        return date($this->formateDate, strtotime(date('Y-m-t', strtotime($date))));
    }    

    // formatWeekdayToChinese({datetime}, {prefix}, {suffix})
    public function formatWeekdayToChinese($datetime, $prefix='', $suffix=''){
        $weekday  = date('w', strtotime($datetime));
        $weeklist = array('日', '一', '二', '三', '四', '五', '六');
        return $prefix.$weeklist[$weekday].$suffix;
    }
}