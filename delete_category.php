<?php

// include function files for this application
require_once('product_sc_fns.php'); 
session_start();

do_html_header('Deleting category');
if (check_admin_user())
{
  if (isset($_POST['cat_id'])) 
  {
    if(delete_category($_POST['cat_id']))
      echo 'Category was deleted.<br />';
    else
      echo 'Category could not be deleted.<br />'
           .'This is usually because it is not empty.<br />';
  } 
  else 
    echo 'No category specified.  Please try again.<br />';
  do_html_url('admin.php', 'Back to administration menu');
}
else 
  echo 'You are not authorised to view this page.'; 

do_html_footer();

?>
