<?php

/**
*
*/
class my_layout{

   public function __construct()
{
            $this->ci =& get_instance();
}


    public $header = 'includes/header';
    public $footer = 'includes/footer';

    public function content($views = '', $data = ''){

        //load hedaer
        if ($this->header) {
            $this->ci->load->view($this->header, $data);
            $data = '';
        }


        //load view
            if (is_array($views)) {
                foreach ($views as $view) {
                    $this->ci->load->view($view, $data);
                    $data = '';
                }
            } else {
                $this->ci->load->view($views, $data);
            }



        //load footer
        if ($this->footer) {
            $this->ci->load->view($this->footer);
        }





    }
}