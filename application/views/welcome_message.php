<?php


if (isset($data)) :
	echo $data;

	if (isset($data1)){
			echo "<pre>";
			print_r($data1['data']);
			echo "</pre>";
	}

	if (isset($data1['arr_data'])) {
			echo "<pre>";
			print_r($data1['arr_data']);
			echo "</pre>";

			$this->load->helper('html');


			$attributes = array(
			                    'class' => 'boldlist',
			                    'id'    => 'mylist'
			                    );

			echo ul($data1['arr_data'], $attributes);
	}



?>

<?php else: ?>

	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

	<input type="button" class="btn btn-success" value="button test for Twitter Bootstrap">


<?php endif ?>
