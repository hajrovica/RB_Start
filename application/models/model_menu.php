<?php

class Model_menu extends RedBean_SimpleModel{


    function add($data = null){
        if (empty($data)) {
            $msg = 'No data to add!';
            return $msg;
        } else {
            //ok lets write propprer store function
            $title = $data['title'];
            $pid = $data['pid'];
            $link = $data['link'];

            //is double function gets 3 parameters table, field name and value of field
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
                    //echo "store ok!";
                    return true;
                } else {
                    //echo "error";
                    return false;
                }

            }

        };


    }

    function delete($id=null){

        //check for children
        $childs = R::find('menu', 'parent_id = ' .$id);

        //if there are any children spiti it out and prevent delete
        if (!empty($childs)) {
            return "There are submenues () for this menu, Delete abandoned! ";

        //if no children we go further
        } else {
            //load bean by id
            $item = R::load('menu', $id);

            //check i fbean is loaded - if no spit out message and stop
            if (!$item->id) {
                $msg = "Nothing to select ?!";
                return $msg;

            } else {
                #if bean is loded print it out TEST part

            print_r($item);
            //R::trash($item);

            //and finaly delete it!
            R::exec( 'delete from menu where id = '.$id );

            #return message on deletion!
            return "Bean deleted!";

            }

        }


    }




    function get_overview($iStart){
        $data = R::find('menu', 'parent_id = ?', array($iStart));
        // echo "<pre>";
        // print_r($data);
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
            print "<br>$key => $value->title\n";


            // so lets build multidimensional array for CI

            $aCategory[$value->id] = $value->title;


                            //****** This is old code buidling array from menu table
                            // $aCategory          = array();
                            // $aCategory['id']    = $catOverview[$key]->id;
                            // $aCategory['title']    = $catOverview[$key]->title;
                            //*********** Old code END *******************************


        //lets get childs if any
            $childs =& self::get_cat_array($key);

            //if there is result add it to childs array
            if (!empty($childs)){
                $aCategory =& $childs;
            }

        //Add category to categories array
        $aCategories[$value->title] = $aCategory;
        }

        //heprint_r($aCategories);
        return $aCategories;

    }

// **************** maintenance functions ************************************************
    private function isDouble($val1=null, $val2=null, $val3=null){
        //ewrite this part it does not work with double values
        $data = R::getRow('select * from '.$val1.' where '.$val2.' like :termin limit 1',
        array(

            ':termin'=>"%$val3%"

            ));
        //echo "<pre>";
        //print_r($data);
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