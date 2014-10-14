<?php
  include ('product_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();
  do_html_header('Copy Cat Limited');

  if(isset($_SESSION['valid-user'])){
    display_cart_top();
  }
  display_twitter_feed();
 
  // if logged in as admin, show add, delete, edit cat links
  if(isset($_SESSION['admin_user']))
  {
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-user" href="admin.php" role="button">Admin Menu</a>';
  }
  do_html_footer();
?>
