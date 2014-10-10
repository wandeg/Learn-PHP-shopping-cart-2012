<?php

// include function files for this application
require_once('product_sc_fns.php'); 
session_start();

do_html_header('Edit product details');
if (check_admin_user())
{
  if ($product = get_product_details($_GET['id']))
  {
    insert_or_edit_product($product);
  }
  else
    echo 'Could not retrieve product details.<br />';
  do_html_url('admin.php', 'Back to administration menu');
}
else
  echo 'You are not authorized to enter the administration area.';

do_html_footer();

?>
