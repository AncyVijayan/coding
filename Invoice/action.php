<?php
	include("config.php");
	$id=$_GET['id'];
	if($qry=mysqli_query($conn,"select * from invoice where invoice_no='$id'"))
	{
		$count=mysqli_num_rows($qry);
		if($count>0)
		{
		$row = mysqli_fetch_array($qry);
				$client_id=$row['client_id'];
				$qry2=mysqli_query($conn,"select * from tb_client where id='$client_id'");
				$count2=mysqli_num_rows($qry2);
				if($count2>0)
				{
					if($row2 = mysqli_fetch_array($qry2))
					{
						$name=$row2['name'];
						$address=$row2['address'];
					}
				}
				$invoice_no=$row['invoice_no'];
				$items = $row['item_id'];
				$date=$row['date'];
				//$description = $row['description'];
				//$quantity = $row['quantity'];
				//$price=$row['price'];
				$total = $row['total_price'];
				//$total=$row['subtotal'];
				$discount=$row['discount'];
				//$granttotal=$_POST['granttotal'];
				$paid=$row['paid'];
				$balance=$row['balance'];	
		}
	}				
 ?>
<!doctype html>
<html lang="en">
	<head>
		<title>Invoice</title>
		<style type="text/css">
		.totals-row td {
			border-right:none !important;
			border-left:none !important;
		}
		.totals-row td strong,.items-table th {
			white-space:nowrap;
		}
		</style>
				<style type="text/css">
			.is_logo {display:none;}
		</style>
			</head>
	<body>
		<div id="editor" class="edit-mode-wrap" style="margin-top: 20px">
			<style type="text/css">
			.is_logo {display:none;}
			</style>
			<style type="text/css">
			* { margin:0; padding:0; }
body { background:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:20px; }
#extra {text-align: right; font-size: 22px; width:250px; font-weight: 700}
.invoice-wrap { width:700px; margin:0 auto; background:#FFF; color:#000 }
.invoice-inner { margin:0 15px; padding:20px 0 }
.invoice-address { border-top: 3px double #000000; margin: 25px 0; padding-top: 25px; }
.bussines-name { font-size:18px; font-weight:100 }
.invoice-name { font-size:22px; font-weight:700 }
.listing-table th { background-color: #e5e5e5; border-bottom: 1px solid #555555; border-top: 1px solid #555555; font-weight: bold; text-align:left; padding:6px 4px }
.listing-table td { border-bottom: 1px solid #555555; text-align:left; padding:5px 6px; vertical-align:top }
.total-table td { border-left: 1px solid #555555; }
.total-row { background-color: #e5e5e5; border-bottom: 1px solid #555555; border-top: 1px solid #555555; font-weight: bold; }
.row-items { margin:5px 0; display:block }
.notes-block { margin:50px 0 0 0 }
/*tables*/
table td { vertical-align:top}
.items-table { border:1px solid #1px solid #555555; border-collapse:collapse; width:100%}
.items-table td, .items-table th { border:1px solid #555555; padding:4px 5px ; text-align:left}
.items-table th { background:#f5f5f5;}
.totals-row .wide-cell { border:1px solid #fff; border-right:1px solid #555555; border-top:1px solid #555555}
</style>
<div class="invoice-wrap">
<div class="invoice-inner">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td align="left" valign="top"><b><font size="5">Invoice</font></b></td>
			<td align="right" valign="top"><p class="editable-text" id="extra"><img class="editable-area" height="102" id="logo" src="img/logo.png" width="122" /></p>
			<p><b>CODING HANDS INFOTECH LLP</b><br>4th Floor , Emarald Mall<br>Calicut-673004<br>Kerala, India<br>0495 3061234 <br>www.codinghands.in<br></p></td></tr>

            </td>
		</tr>
	</tbody>
</table>

<div class="invoice-address">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td align="left" valign="top" width="50%">
			<table border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td style="" valign="top" width=""><strong><span class="editable-text" id="label_bill_to">Bill To</span></strong></td>
						<td valign="top">
						<div class="client_info">
						<table border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
					<td style="padding-left:25px;"><span class="editable-area" id="client_info"><?php echo $name;?><br /></span></td>
								</tr>
                                <tr>
					<td style="padding-left:25px;"><span class="editable-area" id="client_info"><?php echo $address ;?><br /></span></td>
								</tr>
							</tbody>
						</table>
						</div>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
			<td align="right" valign="top" width="50%">
			<table border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td align="right"><strong><span class="editable-text" id="label_invoice_no">Invoice No :</span></strong></td>
						<td align="left" style="padding-left:20px"><span class="editable-text" id="no"><?php echo $invoice_no;?></span></td>
					</tr>
					<tr>
						<td align="right"><strong><span class="editable-text" id="label_date">Date  :</span></strong></td>
						<td align="left" style="padding-left:20px"><span class="editable-text" id="date"><?php date_default_timezone_set('Asia/Kolkata');$date =date('Y-m-d'); echo $date ?></span></td>
					</tr>
					
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</div>

<div id="items-list"><table class="table table-bordered table-condensed table-striped items-table">
	<thead>
		<tr style="align:center">
        	<th>Item Name</th>
			<th>Description</th>
			<th>Unit price</th>
            <th>Quantity</th>
			<th>Total</th>
		</tr>
	</thead>
    <tbody>
    <?php 
	   $json=json_decode($items,true);
	   $subtotal=0;								
		foreach($json as $value)
		{ ?>
					<tr>
				<td><?php echo $value['item']; ?></td>
                <td><?php echo $value['description']; ?></td>
				<td><?php echo $value['price']; ?></td>
				<td><?php echo $value['quantity']; ?></td>
			    <td><?php echo $value['total']; ?></td>
			</tr>
            <?php 
			$subtotal=$value['total']+$subtotal;
		} 
	
		?>
			
			</tfoot>
	<tfoot>
	<?php
	  if($discount==0)
	  {
	?>
			<tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Total</strong></td>
			<td coslpan="2">Rs.<?php echo $total;?></td>
			</tr>
            <tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Paid</strong></td>
			<td coslpan="2">Rs.<?php echo $paid ;?></td>
			</tr>
            <tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Balance Due</strong></td>
			<td coslpan="2">Rs.<?php echo $balance;?></td>
			</tr>
	  <?php
	  }
	  else
	  {
		  ?>
		  <tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Subtotal</strong></td>
			<td coslpan="2">Rs.<?php echo $subtotal;?></td>
			</tr>
			<tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Discount</strong></td>
			<td coslpan="2">Rs.<?php echo $discount ;?></td>
			</tr>
			<tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Total</strong></td>
			<td coslpan="2">Rs.<?php echo $total ;?></td>
			</tr>
            <tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Paid</strong></td>
			<td coslpan="2">Rs.<?php echo $paid ;?></td>
			</tr>
            <tr class="totals-row">
			<td colspan="3" class="wide-cell"></td>
			<td><strong>Balance Due</strong></td>
			<td coslpan="2">Rs.<?php echo $balance;?></td>
			</tr>
			<?php
	  }
	  ?>
				</tbody>
	
</table></div>

<div class="notes-block">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td>
			<div class="editable-area" id="notes" style="font-style:italic"></div>
			</td>
		</tr>
	</tbody>
</table>

</div>
<br />
<br />
<br />
<br />
&nbsp;</div>
</div>
</div>
	<style>
body {
    background: #EBEBEB;
}
.invoice-wrap {box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); margin-bottom: 20px; }
#mobile-preview-close a {
position:fixed; left:20px; bottom:30px; 
color: #fff;
    background-color: #0081D8;
    border-color: #357ebd;
font-weight: 600;
outline: 0 !important;
line-height: 1.5;
border-radius: 3px;
font-size: 14px;
padding: 7px 10px;
border:1px solid #27c24c;
text-decoration:none;
}
#mobile-preview-close img {
	width:20px;
	height:auto;
}
#mobile-preview-close a:nth-child(2) {
left:190px;
background:#f5f5f5;
border:1px solid #9f9f9f;
color:#555 !important;
}
#mobile-preview-close a:nth-child(2) img {
    height: auto;
	position: relative;
top: 2px;
}
.invoice-wrap {padding: 20px;}


@media print {
  #mobile-preview-close a {
  display:none
}
.invoice-wrap {0}
body {
    background: none;
}
.invoice-wrap {box-shadow: none; margin-bottom: 0px;}

}
</style>

<div id="mobile-preview-close">
<!--<a style="color: #fff !important;" href="javascript:window.open('','_self').close();"> <img src="/css/images/arrow-back.png" style="float:left; margin:0 10px 0 0;">Back</a>
--><a style=" margin-left:20px;" href="javascript:window.print();">Print </a>

</div>

<script type="text/javascript">
var beforePrint = function() {
};

var afterPrint = function() {
	document.location.href='index.php';
};

if (window.matchMedia) {
	var mediaQueryList = window.matchMedia('print');
	mediaQueryList.addListener(function(mql) {
		if (mql.matches) {
			beforePrint();
		} else {
			afterPrint();
		}
	});
}
window.onbeforeprint = beforePrint;
window.onafterprint = afterPrint;

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73809851-1', 'auto');
  ga('send', 'pageview');


</script>
</body>
</html>
	