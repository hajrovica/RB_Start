<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Menu extends My_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_menu');
    }

    function index(){

        //show some data
        $data = 'Ok here is some data for view!';
        $data .= "<br>";
        $data .= anchor('menu/add', 'Add menu');
        $data .= "<br>";
        $data .= anchor('menu/list', 'List menu');





        //$model->dispense();
        // $data .= "<br>".$this->model_menu->add(array(
        //     'title'=>'zeleno',
        //     'pid'=>'1',
        //     'link'=>'zeleno'

        //     ));

        $data .= $this->model_menu->get_overview(0);


        //call view and assign data
        $this->view_data['data'] = $data;
        $this->_outpt('welcome_message');


    }
    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    function add()
    {
        $menu = R::dispense('menu');
        $menu->title = 'Voce';
        $menu->parent_id = 0;
        $menu->link = 'voce';


        try {
            R::store($menu);

        } catch (Exception $e) {
            echo $e;
            die();
        }
        echo "<hr>";
        echo $poruka;


        $this->view_data['data'] = $data;
        $this->_outpt('welcome_message');

    }

    function del(){
        $data .= "<br>".$this->model_menu->delete(38);
        $this->view_data['data'] = $data;
        $this->_outpt('welcome_message');

    }







}