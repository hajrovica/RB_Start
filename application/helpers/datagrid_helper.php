<?php

/**
*
*/
class Datagrid{

    //declare private vars for helper
    private $hide_pk_col = TRUE;
    private $hide_cols = array();
    private $tbl_name = '';
    private $pk_col = '';
    private $headings = array();
    private $tbl_fields = array();

    //constructor takes table name and pk col name
    function __construct($tbl_name,  $pk_col = 'id')
    {
        //get instance of CI
        $this->CI           =& get_instance();
        //load database helper
        $this->CI->load->database();
        //get fields from DB
        $this->tbl_fields   = $this->CI->db->list_fields($tbl_name);

        //if there is no pk column in fields result throw exception
        if (!in_array($pk_col, $this->tbl_fields)) {
            throw new Exception("Primary column $pk_col not found in table $tbl_name");
        }

        $this->tbl_name = $tbl_name;
        $this->pk_col   = $pk_col;
        $this->CI->load->library('table');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function setHeadings(array $headings){
        $this->headings = array_merge($this->headings, $headings);
    }

    /**
     * Hide pk column
     *
     * @return void
     * @author
     **/
    public function hidePkCol($bool){
        $this->hide_pk_col = (bool)$bool;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function ignoreFields(array $fields){
        foreach ($fields as $f) {
            if ($f!=$this->pk_col) {
                $this->hide_cols[] = $f;
            }
        }
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    private function _selectFields()
    {
        foreach ($this->tbl_fields as $field) {
            if (!in_array($field, $this->hide_cols)) {
                $this->CI->db->select($field);

                //hide pk column heading
                if ($field == $this->pk_col && $this->hide_pk_col) continue;
                $headings[] = isset($this->headings[$field]) ? $this->headings[$field] : ucfirst($field);
            }
        }

        if (!empty($headings)) {
            //prepend checkbox for toggling
            array_unshift($headings, "<input type='checkbox' class='dg_check_toggler'>" );
            $this->CI->table->set_heading($headings);
        }
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function generate()
    {
        $this->_selectFields();
        $rows   = $this->CI->db
                ->from($this->tbl_name)
                ->get()
                ->result_array();

        foreach ($rows as &$row) {
            $id = $row[$this->pk_col];

            //prepend checkobx to enable selection of items
            array_unshift($row, "<input class='dg_check_item' type='checkbox' name='dg_item[]' value='$id' />");


            //hide pk column
            if ($this->hide_pk_col) {
                unset($row[$this->pk_col]);
            }

        }

        //change table template - add class selector to utilize Bootstrap CSS
        //
        $tmpl = array(
                'table_open'=>'<table class="table table-condensed">'
            );
        $this->CI->table->set_template($tmpl);


        return $this->CI->table->generate($rows);


    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public static function createButtons($action_name, $label)
    {
        return "<input type='submit' class='btn $action_name' name='dg_action[$action_name]' value='$label' />";
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public static function getPostAction()
    {
        //get name of submitted action if any
        if (isset($_POST['dg_action'])) {

           // $act = explode(" ", $_POST['dg_action']);

            return key($_POST['dg_action']);
        }
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public static function getPostItems()
    {
        if (!empty($_POST['dg_item'])) {
                return $_POST['dg_item'];
        }
        return array();
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function deletePostSelection()
    {
        //removeselected items from DB
        if (!empty($_POST['dg_item'])) {
                return   $this->CI->db
                        ->from($this->tbl_name)
                        ->where_in($this->pk_col, $_POST['dg_item'])
                        ->delete();

        }
    }
}

