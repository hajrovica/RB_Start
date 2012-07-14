<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Menu extends My_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_menu', 'menu');
        $this->load->library('grocery_CRUD');
    }


    function index(){

        //ok lets go grocery crud
        // $menu = new grocery_CRUD();
        // $menu->set_table('app_menu');
        // $menu->columns('id', 'title', 'link_type', 'page_id', 'dyn_group_id', 'parent_id', 'is_parent', 'show_menu');
        // $output = $menu->render();


        //lets set some view vars
        //mm maybe to make it function?

        $data = array(
            'title'=>'System menus',
            'output'=>$output
            );

        $views = 'example';
        $this->my_layout->content($views,  $data);





    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    function add()
    {
        // $menu = R::dispense('menu');
        // $menu->title = 'Voce';
        // $menu->parent_id = 0;
        // $menu->link = 'voce';


        // try {
        //     R::store($menu);

        // } catch (Exception $e) {
        //     echo $e;
        //     die();
        // }
        // echo "<hr>";
        // echo $poruka;

        $arr = array(
            'title'     => 'Voce',
            'pid'       =>'0',
            'link'      =>'voce'
            );

        $data = $this->menu->add($arr);

        $this->view_data['data'] = $data;
        $this->_outpt('welcome_message');

    }

    function del(){
        $data .= "<br>".$this->menu->delete(37);
        $this->view_data['data'] = $data;
        $this->_outpt('welcome_message');

    }




    function index_old(){

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

        $data1 = array();
        $data1['data']= $data;
        $data1['arr_data'] = $arr_data = $this->menu->get_cat_array(0);


        //call view and assign data
        $this->view_data['data1'] = $data1;
        $this->view_data['data'] = ' ';
        $this->_outpt('welcome_message');


    }


}