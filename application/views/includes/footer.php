</div>
footer
<!-- /container -->
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    <script src="<?php echo base_url('assets/tb/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets/menu/menu.js'); ?>"></script>

     <?php
     //moved call for GCRUD js files at the end there was a mess when loaded at first place
     //GCRUD JS feature did not worked
     if (isset($output)) {
       $js_files = $output->js_files;

     if (!empty($js_files)) {

     foreach($js_files as $file): ?>

          <script src="<?php echo $file; ?>"></script>
      <?php endforeach;
            }
     }
      ?>

  </body>
</html>
