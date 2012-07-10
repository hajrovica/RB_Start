<?php

/**
*
*/
class My_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function _outpt($val=null){
        $this->view_data['main_content'] = $val;
        $this->load->view('template',  $this->view_data);

    }

}
