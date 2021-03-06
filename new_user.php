<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start(); //starts page session. Required to transfer user info from login to this page using session variables.
include ('connectdb.php'); //brings database connections to this page from the db file to make it easier than adding it to every page.
?>
<html>
<head>
<style>
span.input_form {
  box-sizing: border-box;
  padding: 5px;
  text-align: 20px;
  
  
}
.formbox {
  font-size: 14px;
  display: block;
  height: 35px;
  width: 500px;
  border-radius: 5px;
  margin-left: 10px;
  
  }
</style>
<title>New User</title>
</head>
<body style="background-color:lightgray;">
  <div style=";margin-left:20%;background-color:darkgray;margin-top:5%;box-shadow:5px 5px 10px;border-radius:50px;width:60%;">
    <form style="margin:115px;padding:20px;" method="post">
      <h1 style="text-align:center">New User</h1>
      <hr>
      <span class="input_form">&nbsp;&nbsp; Username<input class="formbox" type="textbox" name="form_user" value="<?php if (isset($_SESSION['username'])) { print $_SESSION['username']; } ?>"></span>
      <span class="input_form">&nbsp; Last Name, First Name<input class="formbox" type="textbox" name="form_name"></input>
      <span class="input_form">&nbsp; Email<input class="formbox" type="textbox" value="<?php if (isset($_POST['form_email'])) { print $_POST['form_email']; } ?>" name="form_email"></span>
      <span class="input_form">&nbsp; Password<input class="formbox" type="password" name="form_pass"></input>
      <span class="input_form">&nbsp; Confirm Password<input class="formbox" type="password" name="form_repass"></input>
      <input class="formbox" style="border-radius:0 0 10px 10px;" type="submit" name="form_sub">
    </form>
    <?php
      if (isset($_POST['form_sub'])) {
        if ($_POST['form_pass'] == $_POST['form_repass']) { //verifies passwords match before adding to database
            $pre_query = mysqli_query($conn, "select * from tickets.users WHERE username = '".$_POST['form_user']."' OR email = '".$_POST['form_email']."'");          
            if (@mysqli_num_rows($pre_query) < 1) {
            $pass = password_hash($_POST['form_pass'], PASSWORD_DEFAULT);
            $query = mysqli_query($conn, "INSERT INTO tickets.users (username, name, email, password) VALUES (".escapeshellarg($_POST['form_user']).",".escapeshellarg($_POST['form_name']).",".escapeshellarg($_POST['form_email']).",".escapeshellarg($pass).")"); //adds new user to database after validation
            if ($query != FALSE) {
              print '<script>alert("User Account Created! Returning to home");</script>';
              print '<meta http-equiv="refresh" content="0;url=login.php">';
            } else {
              print '<h4 style="color:red">Password entry failed. Please try again later or contact your system administrator.</h4>';
            }
          } else {
            echo "<h4>User information already registered. Trying signing in or resetting password!</h4>";
          }
        } else {
          echo "<h4 style='color:red'>Passwords do not match</h4>";
        }
      } 
    ?>
  </div>  
  
</body>
</html>
