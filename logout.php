<?php

// include function files for this application
require_once('product_sc_fns.php'); 
session_start();

if (isset($_SESSION['admin_user'])){
	$old_user = $_SESSION['admin_user'];  // store  to test if they *were* logged in
	unset($_SESSION['admin_user']);
}
else if (isset($_SESSION['valid_user'])){
	$old_user = $_SESSION['valid_user'];  // store  to test if they *were* logged in
	unset($_SESSION['valid_user']);
}

session_destroy();

// start output html
do_html_header('Logging Out');

if (!empty($old_user))
{
  echo 'Logged out.<br />';
  do_html_url('login.php', 'Login');
}
else
{
  // if they weren't logged in but came to this page somehow
  echo 'You were not logged in, and so have not been logged out.<br />';
  do_html_url('login.php', 'Login');
}

do_html_footer();

?>
