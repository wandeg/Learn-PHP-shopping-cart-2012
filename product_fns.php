<?php
function calculate_shipping_cost()
{
  // as we are shipping products all over the world 
  // via teleportation, shipping is fixed
  return 20.00;
}

function get_categories()
{
   // query database for a list of categories
   $conn = db_connect();
   $query = 'select cat_id, catname
             from categories'; 
   $result = @$conn->query($query);
   if (!$result)
     return false;
   $num_cats = @$result->num_rows;
   if ($num_cats ==0)
      return false;  
   $result = db_result_to_array($result);
   return $result; 
}

function get_category_name($cat_id)
{
   // query database for the name for a category id
   $conn = db_connect();
   $query = "select catname
             from categories 
             where cat_id = $cat_id"; 
   $result = @$conn->query($query);
   if (!$result)
     return false;
   $num_cats = @$result->num_rows;
   if ($num_cats ==0)
      return false;  
   $row = $result->fetch_object();
   return $row->catname; 
}


function get_products($cat_id)
{
   // query database for the products in a category
   if (!$cat_id || $cat_id=='')
     return false;
   
   $conn = db_connect();
   $query = "select * from products where cat_id='$cat_id'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   $num_products = @$result->num_rows;
   if ($num_products ==0)
      return false;
   $result = db_result_to_array($result);
   return $result;
}

function get_product_details($id)
{
  // query database for all details for a particular product
  if (!$id || $id=='')
     return false;
   $conn = db_connect();
   $query = "select * from products where id='$id'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   $result = @$result->fetch_assoc();
   return $result;
}

function calculate_price($cart)
{
  // sum total price for all items in shopping cart
  $price = 0.0;
  if(is_array($cart))
  {
    $conn = db_connect();
    foreach($cart as $id => $qty)
    {  
      $query = "select price from products where id='$id'";
      $result = $conn->query($query);
      if ($result)
      {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function calculate_items($cart)
{
  // sum total items in shopping cart
  $items = 0;
  if(is_array($cart))
  {
    foreach($cart as $id => $qty)
    {  
      $items += $qty;
    }
  }
  return $items;
}

?>
