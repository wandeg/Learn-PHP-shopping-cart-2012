<?php

// include function files for this application
require_once('product_sc_fns.php'); 
session_start();

do_html_header('Add a user');
if (check_admin_user())
{
  admin_insert_user_form();
  do_html_url('admin.php', 'Back to administration menu');
}
else
  echo 'You are not authorized to enter the administration area.';

do_html_footer();

?>
