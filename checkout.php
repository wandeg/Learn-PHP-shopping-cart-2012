<?php
  //include our function set
  include ('product_sc_fns.php');

  // The shopping cart needs sessions, so start one
  session_start();

  do_html_header('Checkout');
  
  if($_SESSION['cart']&&array_count_values($_SESSION['cart']))
  {
    display_cart($_SESSION['cart'], false, 0);
    display_checkout_form();
  }
  else
    echo '<p>There are no items in your cart</p>';
 
  echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="show_cart.php" role="button">Continue Shopping</a>';

  do_html_footer();
?>
