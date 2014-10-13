<?php
  include ('product_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  @ $new = $_GET['new'];

  if($new)
  {
    //new item selected
    if(!isset($_SESSION['cart']))
    {
      $_SESSION['cart'] = array();
      $_SESSION['items'] = 0;
      $_SESSION['total_price'] ='0.00';
    }

    if(isset($_SESSION['cart'][$new]))
      $_SESSION['cart'][$new]++;
    else 
      $_SESSION['cart'][$new] = 1;

    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }

  if(isset($_POST['save']))
  {   
    foreach ($_SESSION['cart'] as $id => $qty)
    {
      if($_POST[$id]=='0')
        unset($_SESSION['cart'][$id]);
      else 
        $_SESSION['cart'][$id] = $_POST[$id];
    }
    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }

  do_html_header('Your shopping cart');

  if($_SESSION['cart']&&array_count_values($_SESSION['cart']))
    display_cart($_SESSION['cart']);
  else
  {
    echo '<p>There are no items in your cart</p>';
    echo '<hr />';
  }
  $target = 'shop.php';

  // if we have just added an item to the cart, continue shopping in that category
  if($new)
  {
    $details =  get_product_details($new);
    if($details['cat_id'])    
      $target = 'show_cat.php?cat_id='.$details['cat_id']; 
  }
  echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="'.$target.'" role="button">Continue Shopping</a>';  

  // use this if SSL is set up
  // $path = $_SERVER['PHP_SELF'];
  // $server = $_SERVER['SERVER_NAME'];
  // $path = str_replace('show_cart.php', '', $path);
  // display_button('https://'.$server.$path.'checkout.php', 
  //                  'go-to-checkout', 'Go To Checkout');  

  // if no SSL use below code
  echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="checkout.php" role="button">Checkout</a>';

  
  do_html_footer();
?>
