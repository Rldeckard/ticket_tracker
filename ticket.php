<?php
session_start();
include('connectdb.php');
if (strlen($_SESSION['username']) < 1) {
  header('Location: login.php');
}
?>
<html>
  <title>935TH S6 Ticket Tracker</title>
  <a style="text-align:right" href="logout.php">Logout</a>
  <style>
    
    tr:hover {
      background-color: darkgray;
    }
    td:hover { 
      curser: hand;
    }
    tr {
      background-color: lightgray;
      
    }
    
  </style>
<body>
  <div>
        <h1 style="background-color:grey;padding:15px;border-radius:15px 15px 0 0;position:relative;">Ticket#&nbsp;<?php print $_GET['ID']; print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Summary: '.$_GET['Summary'].'</span>';?></h1>

    <div style="background-color:lightgray;position:relative;top:-26px;padding-bottom:30px">
      <hr>
      <h2 style="padding:5px">Ticket View</h2>
      <div style="background-color:gray;margin:40px;height:200px;border-radius:20px;box-shadow:5px 5px 10px 5px;">
      <h2>Comment Added</h2>
      <?php
        $data_q = mysqli_query($conn, "select * from tickets.summary WHERE ID =".$_GET['ID']);
        if (mysqli_num_rows($data_q) > 0) {
          while ($r = mysqli_fetch_assoc($data_q)) {
            print "Summary: ".$r['summary'];
            print "Comments: ".$r['description'];

          }
        }
?>
        
        </table>
        </div>
      </div>
    </div>  
  </div>
</body>
</html>