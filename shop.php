<?php
  include ('product_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();
  do_html_header('Copy cat Limited');
  

  // get categories out of database
 
 
  // display as links to cat pages
  if (isset($_SESSION['valid_user'])){
    display_cart_top();

    echo '<p>Please choose a category:</p>';

     $cat_array = get_categories();
    display_categories($cat_array);
  }
  else{
    echo "<p>You have to be logged in to shop";
  }
 
  // if logged in as admin, show add, delete, edit cat links
  if(isset($_SESSION['admin_user']))
  {
    display_button('admin.php', 'admin-menu', 'Admin Menu');
  }
  do_html_footer();
?>
