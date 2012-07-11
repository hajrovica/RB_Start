<?php

/**
*
*/
class MY_Layout extends CI_Controller{

   public function __construct()
{
            // foreach (is_loaded() as $var => $class)
            // {
            // $this->$var =& load_class($class);
            // }

            // $this->load =& load_class('Loader', 'core');

            // $this->load->_base_classes =& is_loaded();

            // $this->load->_ci_autoloader();
}

    public $header = 'includes/header';
    public $footer = 'includes/footer';

    public function content($views = '', $data = ''){

        //load hedaer
        if ($this->header) {
            $this->load->view($this->header, $data);
            $data = '';
        }


        //load main can be more than one view
        if (is_array($views)) {

            foreach ($views as $view) {
                $this->load->view($view, $data);
                $data = '';
            }


        } else {
            $this->load->view($views, $data);
        }





        //load footer
        if ($this->footer) {
            $this->load->view($this->footer);
        }



    }
}