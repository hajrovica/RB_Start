<?php

class Model_menu extends RedBean_SimpleModel{

    // function __construct()
    // {
    //     // Call the Model constructor
    //     parent::__construct();
    // }

 // public function update() {
 //  if ( $this->title != 'test' ) {
 //    throw new Exception("Illegal title!");
 //  }
 // }
    //var $poruka = array();


    function add($data = null){

        //ok lets write propprer store function
        $title = $data['title'];
        $pid = $data['pid'];
        $link = $data['link'];

        if (self::isDouble('menu', 'title', $title)) {
           $msg = "There is double in DB!";
           return $msg;

        }else{
            $dt = R::dispense('menu');
            $dt->title = $title;
            $dt->parent_id = $pid;
            $dt->link = $link;
            $id = R::store($dt);

            if ($id) {
                echo "store ok!";return true;
            } else {
                echo "error"; return false;
            }



        };


    }

    function delete($id=null){

        //check for children
        $childs = R::find('menu', 'parent_id = ' .$id);
        if (!empty($childs)) {
            echo "There are submenues () for this menu ";
        } else {

            $item = R::load('menu', $id);
            if (!$item->id) {
                $msg = "Nothing to select ?!";
                echo $msg;

            } else {
                # code...

            print_r($item);
            //R::trash($item)
            R::exec( 'delete from menu where id = '.$id );
            echo "Bean deleted!";
            // if (!$item->id) {
            //         echo "No data to select!";
            //     } else {
            //         echo 'Data selected';
            //         $item = R::trash($item);
            //     }
            }

        }


    }


    function get_overview($iStart){
        $data = R::find('menu', 'parent_id = ?', array($iStart));
        print_r($data);
        return $data;

    }

    function &get_cat_array($iStart){
        //init
        $aCategories = array();

        //call DB
        $catOverview =& $this->get_overview($iStart);

        //for all categpries found
        foreach ($catOverview as $key => $value) {
            //create new cat item
            print "$key => $value->title\n";
            $aCategory          = array();
            $aCategory['id']    = $catOverview[$key]->id;
            $aCategory['title']    = $catOverview[$key]->title;



        //Add category to categories array
        $aCategories[] = $aCategory;
        }

        //print_r($aCategories);
        return $aCategories;

    }

// maintenance functions
    private function isDouble($val1=null, $val2=null, $val3=null){
        //ewrite this part it does not work with double values
        $data = R::getRow('select * from '.$val1.' where '.$val2.' like :termin limit 1',
        array(

            ':termin'=>"%$val3%"

            ));
        //echo "<pre>";
        print_r($data);
       if (!empty($data)) {

            return true;
        } else {
            return false;
        }

    }

    function dispense(){
           $poruka = 'Dispense ok;';
           //echo "$poruka";
           return $poruka;

     }
    function open(){
        echo "open1 <br>";
    }
    function update(){
        echo "update <br>";
    }
    function after_update() {
        $mssg1 = "after_update <br>";

        return $mssg1;
    }

}