<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); //starts page session. Required to transfer user info from login to this page using session variables.
include('connectdb.php'); //brings database connections to this page from the db file to make it easier than adding it to every page.
?>
<html>
<head>
<style>
span.input_form {
  box-sizing: border-box;
  padding: 5px;
  
  
}
.formbox {
  font-size: 14px;
  display: block;
  height: 35px;
  width: 200px;
  border-radius: 5px;
  margin-left: 180px;
  
  }
</style>
<title>Login</title>
</head>
<body style="background-color:lightgray;">
  <div style=";margin-left:20%;background-color:darkgray;margin-top:5%;box-shadow:5px 5px 10px;border-radius:50px;width:60%;">
    <form style="text-align:center;margin:115px;padding:20px;" method="post">
      <h1 style="text-align:center">Login</h1>
      <hr>
      <span class="input_form">&nbsp;Username<input class="formbox" type="textbox" name="log_user"></span>
      <span class="input_form">&nbsp;Password<input class="formbox" type="password" name="log_pass"></span>
      <a href="/ticket_tracker/new_user.php">Create New User</a>
      <input class="formbox" style="border-radius:0 0 10px 10px;" type="submit" name="form_sub">
    </form>
    <?php
      if (isset($_POST['form_sub'])) {
        $_SESSION['username'] = $_POST['log_user'];
        $_SESSION['password'] = $_POST['log_pass'];
        $pass = $_POST['log_pass'];
        $query = mysqli_query($conn, "select password from tickets.users WHERE username = '".$_SESSION['username']."'"); 
        
        if (mysqli_num_rows($query) > 0) {
          while ($a = mysqli_fetch_assoc($query)) {
            $hash = $a['password'];
          }
          if (password_verify($pass, $hash) == FALSE) { 
            print '<h4 style="color:red;position:absolute;left:650px;bottom:300px" class="formbox">Password incorrect!</h4>';
          } else {
            header('Location: /ticket_tracker/index.php');
          }
        } else {
          echo "<h4 style='color:yellow;position:absolute;left:650px;bottom:355px' class='formbox'>Username not found</h4>";
        }
      }
    ?>
  </div>    
</body>
</html>