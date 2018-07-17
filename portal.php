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
<link rel="icon" href="935.jpg">
<title>935TH Ticket Portal</title>
</head>
<body style="background-color:lightgray;">
  <div style=";margin-left:20%;background-color:darkgray;margin-top:5%;box-shadow:5px 5px 10px;border-radius:50px;width:60%;">
    <form style="text-align:center;margin:115px;padding:20px;" method="post">
      <a style="background-color:lightgray;text-decoration:none;color:black;padding:10px;border-radius:10px" href="create_ticket.php" >Create New Ticket</a>
      <a style="background-color:lightgray;text-decoration:none;color:black;padding:10px;border-radius:10px" href="login.php" >Login</a>
      <h1 style="text-align:center">935TH Ticket Portal</h1>
      <hr>
      <span class="input_form">&nbsp;Ticket ID<input class="formbox" type="textbox" name="tick_id"></span>
      <input class="formbox" style="border-radius:0 0 10px 10px;" type="submit" name="form_sub">
    <?php
      if (isset($_POST['form_sub'])) {
        $_SESSION['tick_id'] = $_POST['tick_id'];
        $query = mysqli_query($conn, "select * from tickets.summary WHERE id = '".$_POST['tick_id']."'"); 
        if (mysqli_num_rows($query) > 0) {
          echo "<meta http-equiv='refresh' content='0;url=index.php?ID=".$_POST['tick_id']."' />";
        } else {
          echo "<h4 style='color:red;text-align:center' class='formbox'>Ticket not Found!</h4>";
        }
      }
    ?>
    </form>
  </div>    
</body>
</html>