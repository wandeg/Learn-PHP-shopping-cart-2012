<?php
  include ('product_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $id = $_GET['id'];

  // get this product out of database
  $product = get_product_details($id);
  do_html_header($product['name']);
  if(isset($_SESSION['valid-user'])){
    display_cart_top();
  }
  display_product_details($product);

  // set url for "continue button"
  $target = 'index.php';
  if($product['cat_id'])
  {
    $target = 'show_cat.php?cat_id='.$product['cat_id'];
  }
  // if logged in as admin, show edit product links
  if( check_admin_user() )
  {
    // display_button("edit_product_form.php?id=$id", 'edit-item', 'Edit Item');
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-edit" href="edit_product_form.php?id=$id" role="button">Edit Item</a>';
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-user" href="admin.php" role="button">Admin Menu</a>';
    // display_button($target, 'continue', 'Continue');
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-arrow-right" href="'.$target.'" role="button">Continue </a>';

  }
  else
  {
    // display_button("show_cart.php?new=$id", 'add-to-cart', 'Add '.$product['name'].' To My Shopping Cart'); 
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="show_cart.php?new=$id" role="button">Add '.$product['name'].'to My Shopping Cart</a>';
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="'.$target.'" role="button">Continue Shopping</a>';
  }
  
  do_html_footer();
?>
