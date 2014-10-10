<?php
session_start();
// This file contains functions used by the admin interface 
// for the product-O-Rama shopping cart.

function display_category_form($category = '')
// This displays the category form.
// This form can be used for inserting or editing categories.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_category.php.
// To update, pass an array containing a category.  The
// form will contain the old data and point to update_category.php.
// It will also add a "Delete category" button.
{
  // if passed an existing category, proceed in "edit mode"
  $edit = is_array($category);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>

<form role="form" method='post' action="<?php echo $edit?'edit_category.php':'insert_category.php'; ?>">
  <div class="form-group">
    <label for="catname">Category</label>
    <input type="text" name="catname" class="form-control" value="<?php echo $edit?$category['catname']:''; ?>" id="catname" >
  </div>
  <?php if ($edit) 
         echo '<input type="hidden" name="cat_id" 
                value="'.$category['cat_id'].'">';
      ?>
    <button type="submit" class="btn btn-default"><?php echo $edit?'Update':'Add'; ?> Category</button>
</form>
<?php if ($edit)
       // allow deletion of existing categories 
       {
          echo '<form method="post" action="delete_category.php">';
          echo '<input type="hidden" name="cat_id" value="'.$category['cat_id'].'">';
          echo '<button class="btn btn-default" type="submit">Delete category</button>';
          echo '</form>';
       }
     ?>
  
<?php
}
function insert_or_edit_product($product = '')
// This displays the product form.
// It is very similar to the category form.
// This form can be used for inserting or editing products.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_product.php.
// To update, pass an array containing a product.  The
// form will be displayed with the old data and point to update_product.php.
// It will also add a "Delete product" button.
{
  
  // if passed an existing product, proceed in "edit mode"
  $edit = is_array($product);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form role="form" method='post'action="<?php echo $edit?'edit_product.php':'insert_product.php';?>">
    <label for="pid">ID</label>
    <input type='text' name="pid" value="<?php echo $edit?$product["id"]:''; ?>" id="pid">
    <label for="title">Name </label>
    <input type='text' name="title" id="title" value="<?php echo $edit?$product["name"]:''; ?>">
    <label for="vendor">Vendor</label>
    <input type='text' name='vendor' id="vendor" value="<?php echo $edit?$product['vendor']:''; ?>">
    <label for="cat_id">Category</label>
    <select name='cat_id' id="cat_id">
      <?php
        // list of possible categories comes from database
        $cat_array=get_categories();
        foreach ($cat_array as $thiscat)
        {
             echo '<option value="';
             echo $thiscat['cat_id'];
             echo '"';
             // if existing product, put in current catgory
             if ($edit && $thiscat['cat_id'] == $product['cat_id'])
                 echo ' selected';
             echo '>'; 
             echo $thiscat['catname'];
             echo "\n"; 
        }
        ?>
      </select>
      <label for="price">Price</label>
      <input type='text' name='price' id="price" value="<?php echo $edit?$product['price']:''; ?>">
      <label for="desc">Description</label>
      <textarea rows=3 cols=50 name='description' id="desc">
      <?php echo $edit?$product['description']:''; ?>
      </textarea>
      <?php 
        if ($edit)
        // we need the old isbn to find product in database
        // if the isbn is being updated
        echo '<input type="hidden" name="oldisbn" 
        value="'.$product['isbn'].'">';
      ?>
      <input type='submit' value="<?php echo $edit?'Update':'Add'; ?> Product">
      </form>
      <?php 
      if ($edit)
      {  
        echo '<form method="post" action="delete_product.php">';
        echo '<input type="hidden" name="pid" 
        value="'.$product['pid'].'">';
        echo '<button type="submit">Delete Product</butto>';
        echo '</form>';
      }
      ?>

      </form>

   
<?php
}

function display_product_form($product = '')
// This displays the product form.
// It is very similar to the category form.
// This form can be used for inserting or editing products.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_product.php.
// To update, pass an array containing a product.  The
// form will be displayed with the old data and point to update_product.php.
// It will also add a "Delete product" button.
{
  
  // if passed an existing product, proceed in "edit mode"
  $edit = is_array($product);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method='post'
        action="<?php echo $edit?'edit_product.php':'insert_product.php';?>">
  <table border=0>
  <tr>
    <td>ISBN:</td>
    <td><input type='text' name='isbn' 
         value="<?php echo $edit?$product['isbn']:''; ?>"></td>
  </tr>
  <tr>
    <td>product Title:</td>
    <td><input type='text' name='title' 
         value="<?php echo $edit?$product['title']:''; ?>"></td>
  </tr>
  <tr>
    <td>product Author:</td>
    <td><input type='text' name='author' 
         value="<?php echo $edit?$product['author']:''; ?>"></td>
   </tr>
   <tr>
      <td>Category:</td>
      <td><select name='cat_id'>
      <?php
          // list of possible categories comes from database
          $cat_array=get_categories();
          foreach ($cat_array as $thiscat)
          {
               echo '<option value="';
               echo $thiscat['cat_id'];
               echo '"';
               // if existing product, put in current catgory
               if ($edit && $thiscat['cat_id'] == $product['cat_id'])
                   echo ' selected';
               echo '>'; 
               echo $thiscat['catname'];
               echo "\n"; 
          }
          ?>
          </select>
        </td>
   </tr>
   <tr>
    <td>Price:</td>
    <td><input type='text' name='price' 
               value="<?php echo $edit?$product['price']:''; ?>"></td>
   </tr>
   <tr>
     <td>Description:</td>
     <td><textarea rows=3 cols=50 
          name='description'>
          <?php echo $edit?$product['description']:''; ?>
          </textarea></td>
    </tr>
    <tr>
      <td <?php if (!$edit) echo 'colspan=2'; ?> align='center'>
         <?php 
            if ($edit)
             // we need the old isbn to find product in database
             // if the isbn is being updated
             echo '<input type="hidden" name="oldisbn" 
                    value="'.$product['isbn'].'">';
         ?>
        <input type='submit'
               value="<?php echo $edit?'Update':'Add'; ?> product">
        </form></td>
        <?php 
           if ($edit)
           {  
             echo '<td>';
             echo '<form method="post" action="delete_product.php">';
             echo '<input type="hidden" name="isbn" 
                    value="'.$product['isbn'].'">';
             echo '<input type="submit" 
                    value="Delete product">';
             echo '</form></td>';
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}

function display_password_form()
{
// displays html change password form
?>
<form role="form" action="change_password.php" method="post">
  
  <div class="form-group">
    <label for="oldpass">Old Password</label>
    <input type="password" name="old_passwd" class="form-control" id="oldpass" placeholder="Old Password">
  </div>
  <div class="form-group">
    <label for="newpass">New Password</label>
    <input type="password" name="new_passwd" class="form-control" id="newpass" placeholder="new Password">
  </div>
  <div class="form-group">
    <label for="newpass2">Repeat New Password</label>
    <input type="password" name="new_passwd2" class="form-control" id="newpass2" placeholder="Old Password">
  </div>
  
  <button type="submit" class="btn btn-default">Change Password</button>
</form>

   
<?php
};

function insert_category($catname)
// inserts a new category into the database
{
   $conn = db_connect();

   // check category does not already exist
   $query = "select *
             from categories
             where catname='$catname'";
   $result = $conn->query($query);
   if (!$result || $result->num_rows!=0)
     return false;  

   // insert new category 
   $query = "insert into categories values
            (NULL, '$catname')"; 
   $result = $conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}

function insert_product($id, $name, $cat_id,$vendor, $price, $quantity, $description)
// insert a new product into the database 
{
   $conn = db_connect();

   // check product does not already exist
   $query = "select *
             from products 
             where id='$id'";

   $result = $conn->query($query);
   if (!$result || $result->num_rows!=0)
     return false;
 
   // insert new product
   $query = "insert into products values
            ('$id', '$name', '$cat_id','$vendor', $price,'$quantity','$description')";
  
   $result = $conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}

function update_category($cat_id, $catname)
// change the name of category with cat_id in the database
{
   $conn = db_connect();

   $query = "update categories
             set catname='$catname'
             where cat_id='$cat_id'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true; 
}


function update_product($id,$name, $cat_id, $vendor, $price, 
                     $quantity, $description)
// change details of product stored under $oldisbn in
// the database to new details in arguments
{
   $conn = db_connect();

   $query = "update productss
             set name='$name',
             cat_id ='$cat_id',
             vendor = '$vendor',
             price = '$price',
             quantity = '$quantity',
             description = '$description'
             where id='$id'";

   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true; 
}


function delete_category($cat_id)
// Remove the category identified by cat_id from the db
// If there are products in the category, it will not
// be removed and the function will return false.
{
   $conn = db_connect();
   
   // check if there are any products in category 
   // to avoid deletion anomalies   
   $query = "select *
             from productss
             where cat_id='$cat_id'";
   $result = @$conn->query($query);
   if (!$result || @$result->num_rows>0)
     return false;

   $query = "delete from categories 
             where cat_id='$cat_id'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true; 
}


function delete_product($id)
// Deletes the product identified by $isbn from the database.
{
   $conn = db_connect();

   $query = "delete from products
             where id='$id'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}

?>

