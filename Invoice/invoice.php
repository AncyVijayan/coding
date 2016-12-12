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
                        
                   <label></label>
                          <!--<hr>-->
                <form class="form-horizontal style-form" method="post" action="<?php $PHP_SELF ?>"  >
                       
                         
                            <div class="input-field col s5 ">
                           		
                                <select name="client_id"  id="billto">
                                <option selected> ---  Select  --- </option>
								<?php  
								include("config.php");
								$qur=mysqli_query($conn,"SELECT * FROM `tb_client` ORDER BY `id` DESC");
								$count=mysqli_num_rows($qur);
								if($count>0)
								{
									while($row = mysqli_fetch_array($qur))
									{
								 ?>
                                
                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                               
                                 <?php
									}
								}
								else
								{
									?>
                                     <option value="">No clients</option> 
                                     
                                    <?php
								}
								?>
                              </select>
                                 <label for="billto">Select Client</label>
                   </div>
                               
                   <div class="col s12">
                                <input type="submit" name="view" id="subid" class="btn btn-primary btn-sm subid" value="View">
                               
                   </div>
                   
                   
                   
                   <!-- new code -->
                  
                   <div class="col-lg-12" id="display">
                   
                         <?php
                   if(isset($_POST["view"])=="View")
{
	$client_id=$_POST['client_id'];		
$sql2 ="SELECT * FROM invoice  where client_id='$client_id' order by client_id desc";
$result2 = mysqli_query($conn,$sql2);
$count=mysqli_num_rows($result2);
		if($count>0)
		{
?>
                                <table class="table table-striped table-bordered table-hover bordered" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Invoice NO</th>
                                            <th>Date</th>
                                            <!--<th>Items</th>-->
                                            <th>Total</th>
                                            <th>Discount</th>
                                      		<th>Paid</th>
</tr>
                                    </thead>
                                    <tbody>
                                     <?php
									
$sl=1;
    	

while($rows = mysqli_fetch_array($result2))
  {
  $invoice_no=$rows['invoice_no'];
  $items=$rows['item_id'];
  $date= $rows['date'];
  $total= $rows['total_price'];
  $discount=$rows['discount'];
  $paid=$rows['paid'];
	  ?> 
                                    	<tr>
                                            <!--<td><?php /*?><?php echo $sl++; ?><?php */?></td>-->
                                            <td><?php echo  $invoice_no; ?></td>
                                            <td> <?php echo $date; ?></td>
                                           <?php /*?> <td> <?php echo $items; ?></td><?php */?>
                                            <td> <?php echo $total; ?></td>
                                            <td> <?php echo $discount; ?></td>
                                            <td> <?php echo $paid; ?></td>
                                            <td><a href="action.php?id=<?php echo $rows['invoice_no'];?>">View</a></td>
                                            <td><a href="invoice.php?dltid=<?php echo $rows['invoice_no'];?>"> <img src="img/delete.png" /></a></td>
                                        </tr>
                                        <?php } ?>
                                    <?php

	//echo  pagination($statement,$limit,$page);
?>
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
}
//Deleting  Department query!............
if(isset($_REQUEST['dltid']))
{
$invoice_id=$_REQUEST['dltid'];
$dd="delete from  invoice where invoice_no='$invoice_id'";
//echo $dd;

$dd1=mysqli_query($conn,$dd) or die(mysqli_error());

if($dd1)
{
	echo("<script>alert('Row Deleted Successfuly')</script>");

echo "<meta http-equiv=\"refresh\" content=\"0;URL=invoice.php\">";
//header('location:print_invoice.php');
}
}

//Delete Department query  end............
?>
                           
                </div>
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
<script type="text/javascript">
	

$(document).ready(function() {
    $('select').material_select();
  });
/*$(document).ready(function()
{
	$("#display").hide();
    $(".subid").click(function()
	{
        $("#display").fadeIn()
    });
   
});*/

</script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
  <?php

if(isset($_POST["save"])=="Save")
{
	include("config.php");
	$name=$_POST["name"];
	$address=$_POST["address"];
	$contact=$_POST["contact"];
	if(mysqli_query($conn,"INSERT INTO `tb_client` (`id`, `name`, `address`, `contact`) VALUES (NULL, '$name', '$address', '$contact');"))
	{
		?>
        <script type="text/javascript">
		alert("Created..");
		window.location("index.php");
		</script>
        <?php
	}
		else
		{
			?>
        <script type="text/javascript">
		alert("Error..");
		window.location("index.php");
		</script>
        <?php
	}
	
}
?>
