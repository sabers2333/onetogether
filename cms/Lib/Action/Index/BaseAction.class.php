<?php

class BaseAction extends CommonAction
{
    protected function _initialize()
    {
        parent::_initialize();
        // if (is_mobile_request()) {redirect('wap.php');}
	
   }

    public function _empty()
    {
        exit("你搞错了。");
    }
}


?>
