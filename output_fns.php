<?php

function do_html_header($title = '')
{
  // print an HTML header
 
  // declare the session variables we want access to inside the function  
  if(!isset($_SESSION['items'])) $_SESSION['items'] = '0';
  if(!isset($_SESSION['total_price'])) $_SESSION['total_price'] = '0.00';
?>
  <html>
  <head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </head>
  <body>
  <ul class="nav nav-tabs">  
  <li><a class="navbar-brand" href = 'index.php'>Copy Cat Limited</a></li>
  <li><?php do_html_url('register_form.php','Register') ?></li>
  <li><?php do_html_url('login.php','Login') ?></li>
  <li><?php do_html_url('shop.php','Shop') ?></li>
  <?php $cat_array = get_categories();
    display_category_dropdown($cat_array); ?>
  <li><?php do_html_url('about.php','About us') ?></li>
  <li><?php do_html_url('contact.php','Contact') ?></li>
  </ul>
    
  
<?php
  
}

function display_cart_top(){
  ?>
  <div class="table-responsive">
    <table class="table table-condensed table-hover">
  <tr>
  <td>
  <a href = 'index.php'><img src=''></a>
  </td>
  <td>
  <?php if(isset($_SESSION['admin_user']))
       echo '&nbsp;';
     else
       echo 'Total Items = '.$_SESSION['items'];
       echo 'Total Price = $'.number_format($_SESSION['total_price'],2); 
  ?>
  </td>
  <td>
  <?php if(isset($_SESSION['admin_user']) || isset($_SESSION['valid_user']))
       echo'<a class="btn btn-default btn-lg glyphicon glyphicon-off" href="logout.php" role="button">Log Out</a>';
     else
        echo'<a class="btn btn-default btn-lg glyphicon glyphicon-shopping-cart" href="show_cart.php" role="button">Go to Cart</a>';
       // display_button('show_cart.php', 'view-cart', 'View Your Shopping Cart');
  ?>
  </tr>
  </table>
  </div>
  
  <?php
}


function do_html_footer()
{
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading)
{
  // print heading
?>
  <h2><?php echo $heading; ?></h2>
<?php
}

function do_html_URL($url, $title)
{
  // output URL as link and br
?>
  <a href="<?php echo $url; ?>"><?php echo $title; ?></a><br />
<?php
}

function display_categories($cat_array)
{
  if (!is_array($cat_array))
  {
     echo 'No categories currently available<br />';
     return;
  }
  echo '<ul id="cat_list">';
  foreach ($cat_array as $row)
  {
    $url = 'show_cat.php?cat_id='.($row['cat_id']);
    $title = $row['catname']; 
    echo '<li>';
    do_html_url($url, $title); 
    echo '</li>';
  }    
  echo '</ul>';
  echo '<hr />';
}


function display_category_dropdown($cat_array){
  echo '<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Products <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">';
  if(is_array($cat_array)){
    foreach ($cat_array as $row)
    {
      $url = 'show_cat.php?cat_id='.($row['cat_id']);
      $title = $row['catname']; 
      echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="'.$url.'">'.$title.'</a></li>'; 
      
    }
  }
  
  echo "</ul>
  </div>";  

}

function display_products($product_array)
{
  //display all products in the array passed in
  if (!is_array($product_array))
  {
     echo '<br />No products currently available in this category<br />';
  }
  else
  {
    //create table
    echo '<table class="table table-bordered table-hover" width = \"100%\" border = 0>';
    
    //create a table row for each product    
    foreach ($product_array as $row)
    {
      $url = 'show_product.php?id='.($row['id']);
      echo '<tr><td>';
      if (@file_exists('images/'.$row['img_fname']))
      {
        $title = '<img src="images/'.($row['img_fname']).'" border=0 />';
        do_html_url($url, $title);
      }
      else
      {
        echo '&nbsp;';
      }
      echo '</td><td>';
      $title =  $row['name'].' by '.$row['vendor'];
      do_html_url($url, $title);
      echo '</td></tr>';
    }
    echo '</table>';
  }
  echo '<hr />';
}

function display_product_details($product)
{
  // display all details about this product
  if (is_array($product))
  {
    echo '<table class="table table-bordered table-hover"><tr>'; 
    //display the picture if there is one 
    if (@file_exists('images/'.$product['img_fname']))
    {
      $size = GetImageSize('images/'.$product['img_fname']);
      if($size[0]>0 && $size[1]>0)
        echo '<td><img src="images/'.($product['img_fname']).'" border=0 '.$size[3].'></td>';
    }
    echo '<td><ul>';
    echo '<li><b>Vendor:</b> ';
    echo $product['vendor'];
    echo '</li><li><b>id:</b> ';
    echo $product['id'];
    echo '</li><li><b>Our Price:</b> ';
    echo number_format($product['price'], 2);
    echo '</li><li><b>Description:</b> ';
    echo $product['description'];
    echo '</li></ul></td></tr></table>'; 
  }
  else
    echo 'The details of this product cannot be displayed at this time.';
  echo '<hr />';
}

function display_checkout_form()
{
  //display the form that asks for name and address
?>
  <br />
  <table class="table table-bordered table-hover" border = 0 width = '100%' cellspacing = 0>
  <form action = 'purchase.php' method = 'post'>
  <tr><th colspan = 2 bgcolor='#cccccc'>Your Details</th></tr>
  <tr>
    <td>Name</td>
    <td><input type = 'text' name = 'name' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type = 'text' name = 'address' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type = 'text' name = 'city' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type = 'text' name = 'state' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type = 'text' name = 'zip' value = "" maxlength = 10 size = 40></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type = 'text' name = 'country' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr><th colspan = 2 bgcolor='#cccccc'>Shipping Address (leave blank if as above)</th></tr>
  <tr>
    <td>Name</td>
    <td><input type = 'text' name = 'ship_name' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type = 'text' name = 'ship_address' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type = 'text' name = 'ship_city' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type = 'text' name = 'ship_state' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type = 'text' name = 'ship_zip' value = "" maxlength = 10 size = 40></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type = 'text' name = 'ship_country' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td colspan = 2 align = 'center'>
      <b>Please press Purchase to confirm your purchase,
         or Continue Shopping to add or remove items</b> 
     <?php display_form_button('purchase', 'Purchase These Items'); ?>
    </td>
  </tr>
  </form>
  </table><hr />
<?php
}

function display_shipping($shipping)
{
  // display table row with shipping cost and total price including shipping
?>
  <table class="table table-bordered table-hover" border = 0 width = '100%' cellspacing = 0>
  <tr><td align = 'left'>Shipping</td>
      <td align = 'right'> <?php echo number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor='#cccccc' align = 'left'>TOTAL INCLUDING SHIPPING</th>
      <th bgcolor='#cccccc' align = 'right'>$<?php echo number_format($shipping+$_SESSION['total_price'], 2); ?></th>
  </tr>
  </table><br />
<?php
}

function display_card_form($name)
{
  //display form asking for credit card details
?>
  <table class="table table-bordered table-hover" border = 0 width = '100%' cellspacing = 0>
  <form action = 'process.php' method = 'post'>
  <tr><th colspan = 2 bgcolor="#cccccc">Credit Card Details</th></tr>
  <tr>
    <td>Type</td>
    <td><select name = 'card_type'><option>VISA<option>MasterCard<option>American Express</select></td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type = 'text' name = 'card_number' value = "" maxlength = 16 size = 40></td>
  </tr>
  <tr>
    <td>AMEX code (if required)</td>
    <td><input type = 'text' name = 'amex_code' value = "" maxlength = 4 size = 4></td>
  </tr>
  <tr>
    <td>Expiry Date</td>
    <td>Month <select name = 'card_month'><option>01<option>02<option>03<option>04<option>05<option>06<option>07<option>08<option>09<option>10<option>11<option>12</select>
    Year <select name = 'card_year'><option>00<option>01<option>02<option>03<option>04<option>05<option>06<option>07<option>08<option>09<option>10</select></td>
  </tr>
  <tr>
    <td>Name on Card</td>
    <td><input type = 'text' name = 'card_name' value = "<?php echo $name; ?>" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td colspan = 2 align = 'center'>
      <b>Please press Purchase to confirm your purchase,
         or Continue Shopping to add or remove items</b>
     <?php display_form_button('purchase', 'Purchase These Items'); ?>
    </td>
  </tr>
  </table>
<?php
}



function display_cart($cart, $change = true, $images = 1)
{
  // display items in shopping cart
  // optionally allow changes (true or false)
  // optionally include images (1 - yes, 0 - no)

   echo '<table class="table table-bordered table-hover" border = 0 width = "100%" cellspacing = 0>
        <form action = "show_cart.php" method = "post">
        <tr><th colspan = '. (1+$images) .' bgcolor="#cccccc">Item</th>
        <th bgcolor="#cccccc">Price</th><th bgcolor="#cccccc">Quantity</th>
        <th bgcolor="#cccccc">Total</th></tr>';

  //display each item as a table row
  foreach ($cart as $id => $qty)
  {
    $product = get_product_details($id);
    echo '<tr>';
    if($images ==true)
    {
      echo '<td align = left>';
      if (file_exists('images/'.$product['img_fname']))
      {
         $size = GetImageSize('images/'.$product['img_fname']);  
         if($size[0]>0 && $size[1]>0)
         {
           echo '<img src="images/'.($product['img_fname']).'" border=0 ';
           echo 'width = '. $size[0]/3 .' height = ' .$size[1]/3 . ' />';
         }
      }
      else
         echo '&nbsp;';
      echo '</td>';
    }
    echo '<td align = "left">';
    echo '<a href = "show_product.php?id='.$id.'">'.$product['name'].'</a> by '.$product['vendor'];
    echo '</td><td align = "center">$'.number_format($product['price'], 2);
    echo '</td><td align = "center">';
    // if we allow changes, quantities are in text boxes
    if ($change == true)
      echo "<input type = 'text' name = \"$id\" value = \"$qty\" size = 3>";
    else
      echo $qty;
    echo '</td><td align = "center">$'.number_format($product['price']*$qty,2)."</td></tr>\n";
  }
  // display total row
  echo "<tr>
          <th colspan = ". (2+$images) ." bgcolor=\"#cccccc\">&nbsp;</td>
          <th align = \"center\" bgcolor=\"#cccccc\"> 
              ".$_SESSION['items']."
          </th>
          <th align = \"center\" bgcolor=\"#cccccc\">
              \$".number_format($_SESSION['total_price'], 2).
          '</th>
        </tr>';
  // display save change button
  if($change == true)
  {
    echo '<tr>
            <td colspan = '. (2+$images) .'>&nbsp;</td>
            <td align = "center">
              <input type = "hidden" name = "save" value = true>  
              <a class="btn btn-default btn-lg glyphicon glyphicon-save" href="#" role="button">Save Changes</a>
            </td>
            <td>&nbsp;</td>
        </tr>';
  }
  echo '</form></table>';
}

function display_registration_form()
{
?>
<form class="form-horizontal" role="form" method="post" action="register_new.php">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Preferred Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <label for="passwd" class="col-sm-2 control-label">Password <br />(between 6 and 16 chars)</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="passwd2" class="col-sm-2 control-label">Repeat Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="passwd2" name="passwd2" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="phone" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="phone" name="phone" placeholder="phone">
    </div>
  </div>
  <div class="form-group">
    <label for="address" class="col-sm-2 control-label">Address</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address" name="address" placeholder="address">
    </div>
  </div>
  <div class="form-group">
    <label for="city" class="col-sm-2 control-label">City</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="city" name="city" placeholder="city">
    </div>
  </div>
  <div class="form-group">
    <label for="country" class="col-sm-2 control-label">Country</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="country" name="country" placeholder="country">
    </div>
  </div>
  <div class="form-group">
    <label for="state" class="col-sm-2 control-label">State</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="state" name="state" placeholder="state">
    </div>
  </div>
  <div class="form-group">
    <label for="zip" class="col-sm-2 control-label">Zip</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="zip" name="zip" placeholder="zip">
    </div>
  </div>
    
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Register</button>
    </div>
  </div>
</form>
 
<?php 

}

function display_admin_login_form()
{
  // dispaly form asking for name and password
?>
  <form method='post' action="admin.php">
 <table class="table table-bordered table-hover" bgcolor='#cccccc'>
   <tr>
     <td>Username:</td>
     <td><input type='text' name='username'></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type='password' name='passwd'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value="Log in"></td></tr>
   <tr>
 </table></form>
<?php
}

function display_user_login_form()
{
?>
  <a href='register_form.php'>Not a member?</a>
  <form method='post' action='member.php'>
  <table class="table table-bordered table-hover" bgcolor='#cccccc'>
   <tr>
     <td colspan=2>Members log in here:</td>
   <tr>
     <td>Username:</td>
     <td><input type='text' name='username'></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type='password' name='passwd'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='Log in'></td></tr>
   <tr>
     <td colspan=2><a href='forgot_form.php'>Forgot your password?</a></td>
   </tr>
 </table></form>
<?php

}
function display_admin_menu()
{
?>
<br />
<div id="admin_menu">
<a href="index.php">Go to main site</a><br />
<a href="insert_category_form.php">Add a new category</a><br />
<a href="insert_product_form.php">Add a new product</a><br />
<a href="admin_insert_user_form.php">Add a new user</a><br />
<a href="change_password_form.php">Change admin password</a><br />
</div>

<?php

}
function display_about_us()
{
?>
<br />
<div id="about_us">

</div>

<?php

}

function display_contact_us()
{
?>
<br />
<div id="contact_us">

</div>

<?php

}

function display_twitter_feed()
{
  
?>
<div id="twitter_feed">
  <a class="twitter-timeline" data-tweet-limit="2" height="200" width="300" href="https://twitter.com/wa_ndeg" data-widget-id="520912566613061633">Tweets by @wa_ndeg</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</div>
 <?php
}

function display_button($target, $image, $alt)
{
  echo "<center><a href=\"$target\"><img src=\"images/$image".".gif\" 
           alt=\"$alt\" border=0 height = 50 width = 135></a></center>";
}

function display_form_button($image, $alt)
{
  echo "<center><input type = image src=\"images/$image".".gif\" 
           alt=\"$alt\" border=0 height = 50 width = 135></center>";
}

?>
