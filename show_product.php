<?php
  include ('book_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $id = $_GET['id'];

  // get this product out of database
  $product = get_product_details($id);
  do_html_header($product['name']);
  display_product_details($product);

  // set url for "continue button"
  $target = 'index.php';
  if($product['catid'])
  {
    $target = 'show_cat.php?catid='.$product['catid'];
  }
  // if logged in as admin, show edit product links
  if( check_admin_user() )
  {
    display_button("edit_product_form.php?id=$id", 'edit-item', 'Edit Item');
    display_button('admin.php', 'admin-menu', 'Admin Menu');
    display_button($target, 'continue', 'Continue');
  }
  else
  {
    display_button("show_cart.php?new=$id", 'add-to-cart', 'Add '
                   .$product['name'].' To My Shopping Cart'); 
    display_button($target, 'continue-shopping', 'Continue Shopping');
  }
  
  do_html_footer();
?>
