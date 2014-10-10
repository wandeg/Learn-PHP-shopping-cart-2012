<?php
 require_once("product_sc_fns.php");
 session_start();
 do_html_header("Change password");
 check_valid_user();
 
 display_password_form();

 do_html_url("index.php", "Back to Home");
 do_html_footer();
?>
