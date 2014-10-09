<?php

require_once('db_fns.php');

function register($username, $email, $passwd,$phone,$level,$address,$city,$state,$zip,$country)
// register new person with db
// return true or error message
{
  // connect to db
  $conn = db_connect();
  
  // check if username is unique 
  $result = $conn->query("select * from user where email='$email'"); 
  if (!$result)
    throw new Exception('Could not execute query');
  if ($result->num_rows>0) 
    throw new Exception('There is already an account with that email address - go back and choose another one.');

  $result = $conn->query("select * from user where username='$username'"); 
  if (!$result)
    throw new Exception('Could not execute query');
  if ($result->num_rows>0) 
    throw new Exception('That username is taken - go back and choose another one.');

  // if ok, put in db
  $nowtime = time();
  echo '$nowtime','$username', sha1('$password'), '$email','$phone','$level';
  $result = $conn->query("insert into user values 
                         ('$nowtime','$username', sha1('$password'), '$email','$phone','$level','$address','$city','$state','$zip','$country')");
  if (!$result)
    throw new Exception('Could not register you in database - please try again later.');

  return true;
}

function login_user($username, $password)
// check username and password with db
// if yes, return true
// else throw exception
{
  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = $conn->query("select * from user 
                         where username='$username'
                         and password = sha1('$password')");
  if (!$result)
     throw new Exception('Could not log you in.');
  
  if ($result->num_rows>0)
     return true;
  else 
     throw new Exception('Could not log you in.');
}

function login_admin($username, $password)
// check username and password with db
// if yes, return true
// else return false
{
  // connect to db
  $conn = db_connect();
  if (!$conn)
    return 0;

  // check if username is unique
  $result = $conn->query("select * from user 
                         where username='$username'
                         and password =sha1('$password') and level=4");
  if (!$result)
     return 0;
  
  if ($result->num_rows>0)
     return 1;
  else 
     return 0;
}

function check_valid_user()
// see if somebody is logged in and notify them if not
{
  if (isset($_SESSION['valid_user']))
  {
      echo 'Logged in as '.$_SESSION['valid_user'].'.';
      echo 'Click <a href = "shop.php">'.here.'</a> to start shopping';
      echo '<br />';
  }
  else
  {
     // they are not logged in 
     do_html_heading('Problem:');
     echo 'You are not logged in.<br />';
     do_html_url('login.php', 'Login');
     do_html_footer();
     exit;
  }  
}

function check_admin_user()
// see if somebody is logged in and notify them if not
{
  if (isset($_SESSION['admin_user']))
    return true;
  else
    return false;
}

function change_password_admin($username, $old_password, $new_password)
// change password for username/old_password to new_password
// return true or false
{
  // if the old password is right 
  // change their password to new_password and return true
  // else return false
  if (login_admin($username, $old_password))
  {
    if (!($conn = db_connect()))
      return false;
    $result = $conn->query( "update admin 
                            set password = sha1('$new_password')
                            where username = '$username'");
    if (!$result)
      return false;  // not changed
    else
      return true;  // changed successfully
  }
  else
    return false; // old password was wrong
}


?>
