<?php
/**
*	Datetime helper
*	@author ParkerRo 2018
*/
class dateHelper{

    public $formateDate = "Y-m-d";
    public $formateTime = "h:i:s";

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
  
    // 該月第一天日期; $value = 指定日期
    public function startOfMonth($value = null){
        $value = ($value)?$value:$this->now(); // 如果沒有參數，使用現在時間
        return date($this->formateDate, strtotime(date('Y-m-01', strtotime($value))));
    } 
    
    // 該月最後一天日期; $value = 指定日期    
    public function endOfMonth($value = null){
        $value = ($value)?$value:$this->now(); // 如果沒有參數，使用現在時間
        return date($this->formateDate, strtotime(date('Y-m-t', strtotime($value))));
    }    
}