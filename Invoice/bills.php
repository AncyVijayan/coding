 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link rel="shortcut icon" href="img/favicon.ico" >
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <!-- Navbar goes here -->
        <nav class="top-nav">
        <div class="container">
          <div class="nav-wrapper"><a class="page-title" href="logout.php" style="float:right"><i class="material-icons">settings_power</i></a></div>
        </div>
      </nav>
       <section id="container" >
      
    <!-- Page Layout here -->
    <div class="row">

      <div class="col s3" style="background-color: lightgray;">
       <ul id="nav-mobile" class="side-nav fixed">
        <li class="logo">Coding Hands</li>
        <li class="bold"><a href="index.php" class="waves-effect waves-teal">Generate Invoice</a></li>
        <li class="bold"><a href="print_Bill.php" class="waves-effect waves-teal">Generate Bill</a></li>
        <li class="bold"><a href="invoice.php" class="waves-effect waves-teal">Invoice List</a></li>
		<li class="bold"><a href="bills.php" class="waves-effect waves-teal">Bills</a></li>
        </ul>
      </div>

      <div class="col s9">
        <!-- Teal page content  -->
        <main>
            <div class="section">
                 <section class="wrapper">              
                   <div class="col-lg-12 main-chart">
                      <div class="form-panel"> 
             
                         <?php
                
include("config.php");
$sql2 ="SELECT * FROM tb_receipt order by rec_no desc ";
$result2 = mysqli_query($conn,$sql2);
$count=mysqli_num_rows($result2);
		if($count>0)
		{
?>
                                <table class="table table-striped table-bordered table-hover bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Receipt NO</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                      		<th>Purpose</th>
                                            <th>Mode Of Payment</th>
                                            <th>Paid</th>
                                            <th>Balance</th>
</tr>
                                    </thead>
                                    <tbody>
                                     <?php
									
$sl=1;
    	

while($rows = mysqli_fetch_array($result2))
  {
  $rec_no=$rows['rec_no'];
  $date=$rows['date'];
  $amount = $rows['amount'];
	$name = $rows['name'];
	$purpose = $rows['purpose'];
	$mode=$rows['mode'];
	$paid=$rows['amount_due'];
	$balance=$rows['balance'];
	  ?> 
                                    	<tr>
                                            <!--<td><?php /*?><?php echo $sl++; ?><?php */?></td>-->
                                            <td><?php echo  $rec_no; ?></td>
                                            <td> <?php echo $date; ?></td>
                                            <td> <?php echo $name; ?></td>
                                            <td> <?php echo $amount; ?></td>
                                            <td> <?php echo $purpose; ?></td>
                                             <td> <?php echo $mode; ?></td>
                                              <td> <?php echo $paid; ?></td>
                                               <td> <?php echo $balance; ?></td>
                                            <td><a href="receipt.php?id=<?php echo $rows['rec_no'];?>">View</a></td>
                                            <td><a href="bills.php?dltid=<?php echo $rows['rec_no'];?>"> <img src="img/delete.png" /></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    
                                </table>
                                 <?php
		}
else
{
	echo"<div class='col s12'>";
	echo"<br>No items available.....";
	echo"</div>";
}
//Deleting  Department query!............
if(isset($_REQUEST['dltid']))
{
$recno=$_REQUEST['dltid'];
$dd="delete from  tb_receipt where rec_no='$recno'";
$dd1=mysqli_query($conn,$dd) or die(mysqli_error());
	if($dd1)
	{
		echo("<script>alert('Row Deleted Successfuly')</script>");
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=bills.php\">";
	}
}
?>
                <!-- End-->
                   
                   
                   
                   
                   
                   </div>
                 
          </div>
 
  </section>
            </div>
        </main>
      </div>
    </div>
      <!--Import jQuery before materialize.js
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery.min.js"></script>
 
    <script>
	$(document).ready(function() {
    $('select').material_select();
  });
   
</script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
