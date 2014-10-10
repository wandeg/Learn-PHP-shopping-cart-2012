<?php
function process_card($card_details)
{
  // connect to payment gateway or
  // use gpg to encrypt and mail or
  // store in DB if you really want to

  return true;
}

function insert_order($order_details)
{
  // extract order_details out as variables
  echo extract($order_details);
  // echo gettype($_SESSION['valid_user']);
  // $nom=$_SESSION['valid_user'];

  // set shipping address same as address
  if(!$ship_name&&!$ship_address&&!$ship_city&&!$ship_state&&!$ship_zip&&!$ship_country)
  {
    $ship_name = $name;
    $ship_address = $address;
    $ship_city = $city;
    $ship_state = $state;
    $ship_zip = $zip;
    $ship_country = $country;
  }
  echo $name;
  $conn = db_connect();
 
  // insert customer address
  $query = "select id from user where  
            username = ".$_SESSION['valid_user']."";
  $result = $conn->query($query);
  if($result->num_rows>0)
  {
    $customer = $result->fetch_object();
    $cid = $customer->id;
    // echo $cid;
  }
  
  

  $date = date('Y-m-d');
  $query = "insert into orders values
            ('', '$cid', ".$_SESSION['total_price'].", '$date', 'PARTIAL', '$ship_name',
             '$ship_address','$ship_city','$ship_state','$ship_zip',
              '$ship_country')";

  $result = $conn->query($query);
  if (!$result)

    return false;
  $id = $conn->insert_id;
  // echo $id;

  $query = "select orderid from orders where 
               orderid = $id ";
  $result = $conn->query($query);
  if($result->num_rows>0)
  {
    $order = $result->fetch_object();
    $orderid = $order->orderid;
  }
  else
    // echo "string false";
    return false; 
  
  // insert each product
  foreach($_SESSION['cart'] as $id => $quantity)
  {
    echo $id;
    $detail = get_product_details($id);
    $query = "delete from order_items where  
              orderid = '$orderid' and id =  '$id'";
    $result = $conn->query($query);
    $query = "insert into order_items values
              ('$orderid', '$id', ".$detail['price'].", $quantity)";
    $result = $conn->query($query);
    if(!$result)
      return false;
  }

  return $orderid;
}

?>
