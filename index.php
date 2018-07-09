<?php
session_start();
include('connectdb.php');
$path = "/ticket_tracker";
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
    <h1 style="background-color:grey;padding:15px;border-radius:15px 15px 0 0;position:relative;">Ticket Tracker</h1>
    <div style="background-color:lightgray;position:relative;top:-26px;padding-bottom:30px">
      <hr>
      <h2 style="padding:5px">Ticket View</h2>
      <div style="padding-right:20px;text-align:right;">
        <a style="background-color:darkgray;text-decoration:none;color:black;padding:10px;border-radius:10px" href=" <?php print $path; ?>/create_ticket.php" >Create New Ticket</a>                                            
      </div>
      <div style="background-color:gray;margin:40px;border-radius:20px;box-shadow:5px 5px 10px 5px;">
      <?php
        $c_query = mysqli_query($conn, "show columns from tickets.summary;");
        while($c = mysqli_fetch_assoc($c_query)) {
          $columns[] = $c['Field'];
        }
        ?>
        <div style="padding:15px">
        <table style="width:100%;border:1px black solid;border-collapse:collapse;border-radius:15px">
        <tr style="border:1px black solid;">
<?php   foreach ($columns as $col) {
          if ($col != 'id' && $col != 'priority') { 
            print '<th style="padding:5px;color:white;background-color:black">'.ucfirst($col).'</th>';
            $r_col[] = $col;
          }
        } 
?>
        </tr>
<?php   $data_q = mysqli_query($conn, "select * from tickets.summary;");
        if (mysqli_num_rows($data_q) > 0) {
          while ($r = mysqli_fetch_assoc($data_q)) {
?>          <tr onclick="window.location='ticket.php?ID=<?php print $r['id']; ?>&Summary=<?php print $r['summary']; ?>'" >
<?php
            foreach ($r_col as $col) {
              switch ($r[$col]) {
                case 'Active': $color = '#0AAD3B'; break; 
                case 'Waiting': $color = '#bcbc0f'; break;
                case '1': $color = 'darkred'; $r[$col] = ''; break; //set urgencies
                default: $color = ''; break; //sets default table color to gray
              }
              
              print '<td style="text-align:center;border:1px black solid;padding:10px;background-color:'.$color.'">'.$r[$col].'</td>';
            } 
            print '</tr>';
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