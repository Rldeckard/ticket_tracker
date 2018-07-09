<?php
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
<title>New Ticket</title>
</head>
<body style="background-color:lightgray;">
  <div style=";margin-left:20%;background-color:darkgray;margin-top:5%;box-shadow:5px 5px 10px;border-radius:50px;width:60%;">
    <form style="margin:115px;padding:20px;" method="post">
      <h1 style="text-align:center">New Ticket</h1>
      <hr>
      <span class="input_form">&nbsp;&nbsp; Summary<input class="formbox" type="textbox" placeholder="Help Summary..." name="form_sum"></span>
      <span class="input_form">&nbsp; Requested By<input class="formbox" type="textbox" name="user" placeholder="Guest"></span>
      <span class="input_form">&nbsp; Description<textarea class="formbox" style="padding-bottom:150px;border-radius:0;" name="form_des"></textarea>
      <input class="formbox" style="border-radius:0 0 10px 10px;" type="submit" name="form_sub">
    </form>
    <?php
    if (isset($_POST['form_sub'])) {
      $query = mysqli_query($conn, "INSERT INTO tickets.summary (summary, user, description, priority, status) VALUES (".escapeshellarg($_POST['form_sum']).",".escapeshellarg($_POST['user']).",".escapeshellarg(trim($_POST['form_des'])).",'3','Active');");
      if ($query == TRUE) {
        $q = mysqli_query($conn, "select id from tickets.summary WHERE ID = LAST_INSERT_ID();");
        while ($a = mysqli_fetch_assoc($q)) {
          $tnum = $a['id'];
        }
        print "<script>alert('Your ticket number is ".$tnum.". Please save this number for checking ticket status through the ticketing portal.');</script>";
      } else {
        print mysqli_error($query);
      }
    }
    ?>
  </div>  
  
  
</body>
</html>