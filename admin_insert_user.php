<?php

// include function files for this application
require_once('product_sc_fns.php'); 
session_start();

do_html_header('Adding a user');
if (check_admin_user())
{ 
  if (filled_out($_POST)) 
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    if(admin_insert_user($username,$email,$level))
      echo "User '$username' was added to the database.<br />";
    else
      echo "User '$username' could not be added to the database.<br />";
  } 
  else 
    echo 'You have not filled out the form.  Please try again.';
  do_html_url('admin.php', 'Back to administration menu');
}
else 
  echo 'You are not authorised to view this page.'; 

do_html_footer();

?>