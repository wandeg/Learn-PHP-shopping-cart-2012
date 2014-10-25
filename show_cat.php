<?php
  include ('product_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $cat_id = $_GET['cat_id'];
  $name = get_category_name($cat_id);
 
  do_html_header($name);
  
  if(isset($_SESSION['valid-user'])){
    display_cart_top();
  }

  // get the product info out from db
  $product_array = get_products($cat_id);

  display_products($product_array);
 
  echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="shop.php" role="button">Continue Shopping</a>';
  // if logged in as admin, show add, delete product links
  if(isset($_SESSION['admin_user']))
  {
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-user" href="admin.php" role="button">Admin Menu</a>';
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-user" href="edit_category_form.php?cat_id='.$cat_id.'" role="button">Edit Category</a>';
    // display_button("edit_category_form.php?cat_id=$cat_id",'edit-category', 'Edit Category');

  }
  else
   
  
  do_html_footer();
?>
