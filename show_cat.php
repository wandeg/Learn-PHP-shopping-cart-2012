<?php
  include ('book_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);
 
  do_html_header($name);

  // get the product info out from db
  $product_array = get_products($catid);

  display_products($product_array);
 

  // if logged in as admin, show add, delete product links
  if(isset($_SESSION['admin_user']))
  {
    display_button('index.php', 'continue', 'Continue Shopping');
    display_button('admin.php', 'admin-menu', 'Admin Menu');
    display_button("edit_category_form.php?catid=$catid", 
     'edit-category', 'Edit Category');
  }
  else
    display_button('index.php', 'continue-shopping', 'Continue Shopping');
  
  do_html_footer();
?>
