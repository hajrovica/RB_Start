<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Test extends My_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('datagrid');
        $this->Datagrid = new Datagrid('users', 'id');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    function index()
    {
        $this->load->helper('form');
        $this->load->library('session');

        $this->Datagrid->hidePkCol(false);
        $this->Datagrid->setHeadings(array('email'=>'E-mail'));
        $this->Datagrid->ignoreFields(array('password'));

        if ($error = $this->session->flashdata('form_error')) {
            echo "<font color=red>$error</font>";
        }

        $output = form_open('test/proc', array('class'=>'dg_form'));
        $output .= $this->Datagrid->generate();
        $output .= $this->Datagrid->createButtons('delete', 'Delete');
        $output .= form_close();




             $data = array(
            'title'=>'DataGrid helper',
            'data'=>$output
            );

        $views = 'welcome_message';
        $this->my_layout->content($views,  $data);

    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    function proc($request_type='')
    {
        //load helper URL line omitted
        if ($action = Datagrid::getPostAction()){
            $error = '';
                    switch ($action) {
                        case 'btn delete':
                            if (!$this->Datagrid->deletePostSelection()) {
                                $error = 'Items could not be deleted!';
                            }
                            break;


                    }

                if ($request_type!='ajax') {
                    $this->load->library('session');
                    $this->session->set_flashdata('form_error', $error);
                    redirect('test/index');
                    }else{
                    echo json_encode(array('error'=>$error));

                }
            }else{

                die('Bad request');
            }
        }
    }