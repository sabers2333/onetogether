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
        redirect('http://'.$_SERVER['HTTP_HOST'].'/yqc.html');
    }
}


?>
