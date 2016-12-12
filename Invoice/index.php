 <?php  
	include("config.php");
	session_start();
if($_SESSION['NAME']==null)
{
	header('location:login.php');
}

?>
 <!DOCTYPE html>
  <html>
    <head>
    <title>Coding Hands</title>
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
                <form class="form-horizontal style-form" method="post"  action="<?php $PHP_SELF ?>">
                       
                         
                            <div class="input-field col s2 ">
                           		
                                <select name="client_address"  id="billto">
                                <option selected> ---  Select  --- </option>
								<?php  
								//include("config.php");
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
                                 <label for="billto">Bill To</label>
                   </div>
                               
                   <div class="col s6">
                                <!-- Modal Trigger -->
                                <br>
  							<a class="waves-effect waves-light btn" href="#modal1">New Client</a>
                                 </div>
                   <div class="col-sm-12">
              <form class="form-horizontal style-form" method="post"  action="check.php">
                        <table class="dataTable" border="1" >
                            <tr style="border-top: 0;background: #0081D8;color: #fff;">
                                <th style="text-align:center;">Item</th>
                                <th style="text-align:center;">Description</th>
                                <th style="text-align:center;">Price</th>
                                <th style="text-align:center;">Quantity</th>
                                <th style="text-align:center;">Total</th>
                             	<th></th>
                            </tr>
                            <!--<tbody id="test">-->
                            
                            <tr> 
                            <td><input type="text"  name="item[]" id="tname" class="form-control" required placeholder="Item Name"></td>
                            <td> <textarea id="textarea1"  name="description[]" class="input-field col s12 validate" placeholder="Description"></textarea></td>
                            <td><input type="text"  name="price[]" id="price" class="price form-control" required placeholder="Price"></td>
                            <td><input type="text"  name="quantity[]" id="quantity" class="quantity form-control" onBlur="findTotal()" required placeholder="Quantity" ></td>
                            <td><input type="text"  name="total[]" id="total" class="total form-control"  placeholder="Total"  readonly ></td>
                            <td></td>
                            </tr>
                            <!--</tbody>-->
                           
		<tbody id="dis_sec">
             <tr  class="totals-row"  >
            <td colspan="3" class="wide-cell"></td>
			<td><strong>Subtotal</strong></td>
			<td ><input type="text"  name="subtotal" id="subtotal" class="subtotal form-control"  onBlur="Discount();" value="0" readonly ></td>
			</tr>
            <tr  class="totals-row"  >
            <td colspan="3" class="wide-cell"></td>
			<td><strong>Discount</strong></td>
			<td ><input type="text"  name="discount" id="discount" class="form-control" value="0"  readonly ></td>
			</tr>
			
			<tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Total</strong></td>
			<td ><input type="text"  name="distotal" id="distotal" class="distotal form-control" value="0" readonly ></td>
            </tbody>
            <tfoot id="foottable">
            <tr class="totals-row" id="tot_hide">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Total</strong></td>
			<td ><input type="text"  name="granttotal" id="granttotal" class="granttotal form-control" value="0" readonly ></td>
			</tr>
            
           
            
           
            <tr class="totals-row">
            <td colspan="3" class="wide-cell"></td>
			<td><strong>Paid</strong></td>
			<td ><input type="text"  name="paid" id="paid" class="paid form-control" ></td>
			</tr>
            <tr class="totals-row">
            <td colspan="3" class="wide-cell"></td>
			<td><strong>Balance</strong></td>            
			<td ><input type="text"  name="balance" id="balance" class="balance form-control" readonly></td>
			</tr>
            </tfoot>
            </table>
 <button type="button" class="plusbtn btn-floating  waves-effect waves-light blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="New Item" ><i class="material-icons">add</i> </button>
<!--<a class="plusbtn btn-floating  waves-effect waves-light blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="New Item" ><i class="material-icons">add</i></a>
-->
<a class="btn-floating  waves-effect waves-light blue tooltipped" href="#dis_section" name="discount" value="%" data-position="bottom" data-delay="50" data-tooltip="Discount"  ><i class="material-icons right"><font size="5">%</font></i></a>
                          
 </div>
               <p>&nbsp;</p>
              </div>
         
                         
                            <div class="col-sm-12" style="text-align:left">
							<button type="submit" name="save" id="subid" class="btn waves-effect waves-light" value="save">Save <i class="material-icons left">save</i></button>
                   <!-- <input type="submit" name="preview" id="subid" class="btn btn-primary btn-sm" value="Preview"></button>
                          <input type="button" name="discount" id="discount" class="discount btn btn-primary btn-sm" value="Descount" onclick="toggle_visibility('dis_sec');"></button>
                          -->  
						  </div>
                      <p>&nbsp;</p>
                  </form>
              </div>
          </div>
 <!-- Add new client -->
 	<?php 
	if($qry=mysqli_query($conn,"select max(id) from `invoice_db`.`tb_client`"))
	{
		$roww = mysqli_fetch_array($qry);
		$cid=$roww[0];
		$cid=$cid+1; 
	}	
	?>
  <div id="modal1" class="modal">      
    <div class="row">
    <form name="client" action="<?php $PHP_SELF ?>" method="post">
      <div class="row" >
        <div class="input-field col s12">
          <input placeholder="Name" name="clname" id="clname" type="text" class="validate" style="width:60%" value="" required>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s12">
          <textarea id="address" name="address"  placeholder="Address"class="materialize-textarea" style="width:60%" required></textarea>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="contact" type="text" name="contact" placeholder="Contact" class="validate" style="width:60%" required>
        </div>
      </div>
	  <div >
        <div class="input-field col s12">
          <input name="cid" id="cid" type="hidden" value="<?php echo $cid;?>">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
      <input type="submit" name="savebtn" class="modal-action waves-effect waves-green btn-flat btn btn-primary btn-sm" value="Save">
      <input type="button" class="modal-action modal-close waves-effect waves-green btn-flat btn btn-primary btn-sm" value="Cancel">     
    </div>
    </div>
    </form> 
   </div>
    
  </div>
  
  <!-- Eend -->
   <!-- discount Trigger -->
  <!--<a class="waves-effect waves-light btn" >Modal</a>-->

  <!-- Modal Structure -->
  <div id="dis_section" class="modal" style="width:25% !important">
    <div class="modal-content">
     <div >
        <div class="input-field col s12" >
          <input placeholder="Enter Percentage" name="percentage" id="percentage" type="text" class="validate" style="width:60%" required>
          <label for="percentage">Percentage</label>
        </div>
      </div>
    </div>
    <div class="modal-footer">
		<input type="button" value="Done" class="done modal-close waves-green btn-flat"> 
    </div>
  </div>
        </div>
              </div>
          </section>
      </section>
 
  </section>
            </div>
        </main>
      </div>

    </div>
      <!--Import jQuery before materialize.js
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	
	
$('.dataTable').on('click', 'button', function () 
{
    $(this).closest('tr').remove();
	findTotal();
	//Discount();
	
})
$('.plusbtn').click(function () {
	 $('.dataTable').append('<tr> <td><input type="text"  name="item[]" id="tname" class="form-control" required placeholder="Item Name"></td><td> <textarea id="textarea1"  name="description[]" class="input-field col s12 validate" placeholder="Description"></textarea></td>       <td><input type="text"  name="price[]" id="price" class="price form-control" required placeholder="Price"></td><td><input type="text"  name="quantity[]" id="quantity" class="quantity form-control" onBlur="findTotal()" required placeholder="Quantity" ></td><td><input type="text"  name="total[]" id="total" class="total form-control"  placeholder="Total"  readonly ></td><td><button type="button" class="btn-floating  waves-effect waves-light blue tooltipped" ><i class="material-icons">cancel</i></button></td></tr>')
	Discount();
	 });	
	
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
$(document).ready(function() {
    $('select').material_select();
  });
 function toggle_visibility(id) 
 {
       var e = document.getElementById(id);
       if(e.style.display == 'none')
          e.style.display = 'block';
       else
          e.style.display = 'none';
  }
function findTotal()
{
    var arr = document.getElementsByName('total[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('granttotal').value = tot;
	//document.getElementById('distotal').value = tot;
	document.getElementById('subtotal').value = tot;
	Discount();
}
function minus(){
    var arr = document.getElementsByName('total[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
			
    }
    document.getElementById('granttotal').value = tot;
	//document.getElementById('distotal').value = tot;
	document.getElementById('subtotal').value = tot;
}


$(document).ready(function() {
    $('.dataTable').on('change', '.price', calTotal)
                  .on('change', '.quantity', calTotal);

// find the value and calculate it 
$('#foottable').on('change', '.paid', calBalance)
//$('#foottable').on('change', '.granttotal', calDiscount)
$('#dis_sec').on('change', '#subtotal', calDiscount)
$('#dis_sec').on('change', '#subtotal', calBalance)
$('.modal-content').on('change','#percentage',calDiscount)


//Dis
 function calDiscount()
 {
	 $percent=$('.modal-content').find('#percentage').val();
	 $old_price=$('#dis_sec').find('.subtotal').val();
	 $discount_value = ($old_price / 100) * $percent;
	 $new_price = $old_price - $discount_value;
	 $('#dis_sec').find('#discount').val($discount_value);
	 $('#dis_sec').find('.distotal').val($new_price);
 }

 
// find the value and calculate it
    function calTotal() 
	{
        var $row = $(this).closest('tr'),
            price    = $row.find('.price').val(),
            quantity = $row.find('.quantity').val(),
            total    = price * quantity;

// change the value in total

        $row.find('.total').val(total)
    }
//balance function
	function calBalance() 
	{
        var $row = $(this).closest('tfoot'),
            granttotal = $('#dis_sec').find('.distotal').val(),
            paid = $row.find('.paid').val(),
			/*if(granttotal>=paid)
			{*/
             balance    = granttotal-paid;
			//}
// change the value in balance

        $row.find('.balance').val(balance)
    }


});
$(document).ready(function()
{
	 $("#dis_sec").hide();
    $(".done").click(function()
	{
        $("#dis_sec").fadeIn()
		$("#tot_hide").hide();
    });
   
});
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.dis_section').modal();
  });
function Discount()
 {
	 $percent=$('.modal-content').find('#percentage').val();
	 $old_price=$('#dis_sec').find('.subtotal').val();
	 $discount_value = ($old_price / 100) * $percent;
	 $new_price = $old_price - $discount_value;
	 $('#dis_sec').find('#discount').val($discount_value);
	 $('#dis_sec').find('.distotal').val($new_price);
 }
</script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
  <?php

if(isset($_POST["savebtn"])=="Save")
{
	include("config.php");
	$name=$_POST["clname"];
	$address=$_POST["address"];
	$contact=$_POST["contact"];
	
	if(mysqli_query($conn,"INSERT INTO `tb_client` (`id`, `name`, `address`, `contact`) VALUES (NULL, '$name', '$address', '$contact');"))
	{
		?>
        <script type="text/javascript">
		alert("Created..");
		/* var xid=document.getElementById("cid").value;
		var clientname=document.getElementById('clname').value;
		alert(xid);
		alert(clientname);
		$('<option>').val(xid).text(name).appendTo('#billto');
		$("#billto").val(xid); */
		</script>		
        <?php
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
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
else if(isset($_POST["save"])=="save")
{	
				//include("config.php");
				//$chkbox = $_POST['chk'];
				$client_id = $_POST['client_address'];
				$item = $_POST['item'];
				$description = $_POST['description'];
				$quantity = $_POST['quantity'];
				$price=$_POST['price'];
				$total = $_POST['total'];
				$discount=$_POST['discount'];
				$granttotal=$_POST['distotal'];
				$paid=$_POST['paid'];
				$balance=$_POST['balance'];	
				//echo"$client_id <br>  $balance <br> $discount <br> $granttotal";
				date_default_timezone_set('Asia/Kolkata');
				$date =date('Y-m-d');
				$temp=array();
				foreach($item as $a => $b)
				{
					
					$temp["item"]=$item[$a]; 
					$temp["description"]=$description[$a]; 
				    $temp["price"]=$price[$a]; 
					$temp["quantity"]=$quantity[$a];  
					$temp["total"]=$total[$a];  
					$itemarray[]=$temp;
				}
				$items=json_encode($itemarray);
				if(mysqli_query($conn,"INSERT INTO `invoice` (`invoice_no`, `client_id`, `date`, `item_id`, `total_price`, `discount`, `paid`, `balance`) VALUES (NULL, '$client_id', '$date', '$items', '$granttotal', '$discount', '$paid', '$balance');"))
				{
					echo("<script>alert('Saved Successfuly')</script>");
					
					header('location:index.php');
				}
				else
				{
					die("".mysqli_error($conn));
					?>
					<script type="text/javascript">
					alert("Error.");
					window.location("index.php");
					</script>
					<?php
				}
}

?>
