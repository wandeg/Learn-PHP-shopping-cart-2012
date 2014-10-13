<?php
  include ('product_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  do_html_header('Checkout');
  
  if(isset($_SESSION['valid-user'])){
    display_cart_top();
  }

  $card_type = $_POST['card_type'];
  $card_number = $_POST['card_number'];
  $card_month = $_POST['card_month'];
  $card_year = $_POST['card_year'];
  $card_name = $_POST['card_name'];

  if($_SESSION['cart']&&$card_type&&$card_number&&
     $card_month&&$card_year&&$card_name )
  {
    //display cart, not allowing changes and without pictures 
    display_cart($_SESSION['cart'], false, 0);

    display_shipping(calculate_shipping_cost());  

    if(process_card($_POST))
    {
      //empty shopping cart
      session_destroy();
      echo 'Thankyou for shopping with us.  Your order has been placed.';
      echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="shop.php" role="button">Continue Shopping</a>';
    }
    else
    {
    echo 'Could not process your card. ';
    echo 'Please contact the card issuer or try again.';
      echo'<a class="btn btn-default btn-lg glyphicon glyphicon-arrow-left" href="purchase.php" role="button">Back</a>';
    }
  }
  else
  {
    echo 'You did not fill in all the fields, please try again.<hr />';
    echo'<a class="btn btn-default btn-lg glyphicon glyphicon-arrow-left" href="purchase.php" role="button">Back</a>';
  } 
 
  do_html_footer();
?>
