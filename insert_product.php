<?php

// include function files for this application
require_once('product_sc_fns.php'); 
session_start();

do_html_header('Adding a Product');
if (check_admin_user())
{ 
  
  
  if (filled_out($_POST)) 
  {
    $pid = $_POST['pid'];
    $title = $_POST['title'];
    $cat_id = $_POST['cat_id'];
    $vendor = $_POST['vendor'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $img_fname = $_POST['img_fname'];
    $description = $_POST['description'];
    // echo "('$pid', '$title', '$cat_id','$vendor', $price,'$quantity','$description')";

    $target_dir = "images/";
    $target_dir = $target_dir . basename( $_FILES["img_fname"]["name"]);
    copy($_FILES["img_fname"]["tmp_name"], $target_dir);
    //echo($img_fname);
    //echo $imgname;

    if(insert_product($pid, $title, $cat_id,$vendor, $price, $quantity,$img_fname, $description))
      echo "Product '".stripslashes($title)."' was added to the database.<br />";
    else
      echo "Product '".stripslashes($title).
           "' could not be added to the database.<br />";
  } 
  else 
    echo 'You have not filled out the form.  Please try again.';
  do_html_url('admin.php', 'Back to administration menu');
}
else 
  echo 'You are not authorised to view this page.'; 

do_html_footer();

?>
