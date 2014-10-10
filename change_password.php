<?php
 require_once('product_sc_fns.php');
 session_start();
 do_html_header('Changing password');
 check_valid_user();
 if (!filled_out($_POST))
 {
   echo 'You have not filled out the form completely.
         Please try again.';
   do_html_url('index.php', 'Back to Home');
   do_html_footer();  
   exit;
 }
 else 
 {
    $new_passwd = $_POST['new_passwd'];
    $new_passwd2 = $_POST['new_passwd2'];
    $old_passwd = $_POST['old_passwd'];
    if ($new_passwd!=$new_passwd2)
       echo 'Passwords entered were not the same.  Not changed.';
    else if (strlen($new_passwd)>16 || strlen($new_passwd)<6)
       echo 'New password must be between 6 and 16 characters.  Try again.';
    else
    {
        // attempt update
        if (change_password($_SESSION['valid_user'], $old_passwd, $new_passwd))
           echo 'Password changed.';
        else
           echo 'Password could not be changed.';
    }


 }
  do_html_url('index.php', 'Back to Home');  
  do_html_footer();
?>
