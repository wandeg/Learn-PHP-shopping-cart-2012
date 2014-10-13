<?php

  include ('product_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  do_html_header("Checkout");
  // create short variable names
  if(isset($_SESSION['valid-user'])){
    display_cart_top();
  }
  
  $name = $_POST['name'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  $country = $_POST['country'];

  // if filled out
  if($_SESSION['cart']&&$name&&$address&&$city&&$zip&&$country)
  {
    // able to insert into database
    if( insert_order($_POST)!=false )
    {
      //display cart, not allowing changes and without pictures 
      display_cart($_SESSION['cart'], false, 0);

      display_shipping(calculate_shipping_cost());  

      //get credit card details
      display_card_form($name);

      echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="show_cart.php" role="button">Continue Shopping</a>';  
    }
    else
    {
      echo 'Could not store data, please try again.';
      echo'<a class="btn btn-default btn-lg glyphicon glyphicon-arrow-left" href="checkout.php" role="button">Checkout</a>';
    }
  }
  else
  {
    echo 'You did not fill in all the fields, please try again.<hr />';
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-arrow-left" href="checkout.php" role="button">Checkout</a>';
  } 
 
  do_html_footer();
?>
