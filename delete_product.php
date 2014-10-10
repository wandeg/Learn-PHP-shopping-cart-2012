<?php

// include function files for this application
require_once('product_sc_fns.php'); 
session_start();

do_html_header('Deleting Product');
if (check_admin_user())
{
  if (isset($_POST['id'])) 
  {
    $id = $_POST['id'];
    if(delete_product($id))
      echo 'Product '.$id.' was deleted.<br />';
    else
      echo 'Product '.$id.' could not be deleted.<br />';
  } 
  else 
    echo 'We need a product id to delete a product.  Please try again.<br />';
  do_html_url('admin.php', 'Back to administration menu');
}
else 
  echo 'You are not authorised to view this page.'; 

do_html_footer();

?>
