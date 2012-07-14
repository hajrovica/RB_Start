<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="<?php echo base_url();?>" />

    <!-- Le styles -->
    <link href="<?php echo base_url('assets/tb/css/bootstrap.css');  ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/menu/menu.css');  ?>" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="?php echo base_url('/assets/tb/css/bootstrap-responsive.css');  ?>" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>/assets/tb/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>/assets/tb/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>/assets/tb/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>/assets/tb/ico/apple-touch-icon-57-precomposed.png">

    <script type="text/javascript"> <![CDATA[
        var base_url = '<?php echo base_url();?>';
        ]]></script>
    </Script>

    <?php

    //point out that js_files and css_files are now objects of output - using layout library
    if (isset($output)) {
        $css_files = $output->css_files;

        foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

        <?php endforeach;
    }

    ?>



  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="">GART rewrite</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="menu">Menu</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
             <?php

            //echo  $this->dynamic_menu->build_menu('1'); ?>


          </div><!--/.nav-collapse -->

        </div>
      </div>
 </div>
    <hr style="clear:both">

    <div class="container">

      <h1>Bootstrap starter template</h1>
      <p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>
      <p>
      <br>
      <br>
      <br> </p>
      <p>Here starts actual view - Up part is header  <hr> </p>

