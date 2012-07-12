<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends My_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');

	}

	function _example_output($output = null)
	{
		$this->load->view('example.php',$output);
	}

	function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}

	function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	function offices_management()
	{
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');

			$this->view_data['output']=$output = $crud->render();

			//$this->_example_output($output);
			$this->_outpt('welcome_message');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');

			$crud->required_fields('lastName');

			$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();

			$this->_example_output($output);
	}

	function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','{lastName} {firstName}');

			$output = $crud->render();

			$this->_example_output($output);
	}

	function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_example_output($output);
	}

	function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();

			$this->_example_output($output);
	}

	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	function film_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		$output = $crud->render();

		$this->_example_output($output);
	}


//********************** EXAMPLES *************************************************************************************
//***************************Template library added - http://superdit.com/2011/05/02/codeigniter-layout-library-for-autoload-frequently-used-views/ ********
//********* resolved template issue with CI =&  get_instance  *******************************************
//*****************Look further comments **************************************************


	function aaa(){

		//lets make some GCRUD stuff copy&paste
		$crud = new grocery_CRUD();
		//$crud->set_theme('datatables');
		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		//and we get output in object of std class?
		$output = $crud->render();



		//so we are using layout lib for this which gets only $data array
		//pass var
		$title = 'dynamic string';
		//pass views to use
		$views = array(
			'content'=>'welcome_message',
			'gcrud'=>'example'
			);


		//make array and give to it required values
		$data = array(
			'title'=>$title,
			'data'=>'DAAAAATTTTTAAAAAA',
			'output'=>$output
			);
		//this effectivly will pass output inside output container  so $output
		//in view will be std class with objects [output] - this is called in view
		//and pbjects [js_files] and [css_files] this is for header
		//$this->my_layout->footer = FALSE;
		$this->my_layout->content($views,  $data);

	}

}