<?php
include("config.php");
session_start();	
$recno=$_GET["id"];
$sql2 ="SELECT * FROM tb_receipt  where rec_no='$recno'";
$result2 = mysqli_query($conn,$sql2);
while($rows = mysqli_fetch_array($result2))
 {
    $rec_no=$rows['rec_no'];
    $date=$rows['date'];
    $total = $rows['amount'];
    $from = $rows['name'];
	$purpose = $rows['purpose'];
	$mode=$rows['mode'];
	$amount=$rows['amount'];
	$received=$rows['amount_due'];
	$balance=$rows['balance'];
  }
	
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Coding hands</title>
        <link rel="shortcut icon" href="img/favicon.ico" >
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <style type="text/css">
		input { 
    text-align:center; 
}
		.row .col.s1 {
  width: 8.3333333333%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s2 {
  width: 16.6666666667%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s3 {
  width: 25%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s4 {
  width: 33.3333333333%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s5 {
  width: 41.6666666667%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s6 {
  width: 50%;
  margin-left: auto;
  left: auto;
  right: auto;
  float:left;
}

.row .col.s7 {
  width: 58.3333333333%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s8 {
  width: 66.6666666667%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s9 {
  width: 75%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s10 {
  width: 83.3333333333%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s11 {
  width: 91.6666666667%;
  margin-left: auto;
  left: auto;
  right: auto;
}

.row .col.s12 {
  width: 100%;
  margin-left: auto;
  left: auto;
  right: auto;
}
}
.row .col {
    float: left;
    box-sizing: border-box;
    padding: 0 0.75rem;
    min-height: 1px;
}
.input-field {
    position: relative;
    margin-top: 1rem;
}
		input:not([type]),input[type=text],input[type=password],input[type=email],input[type=url],input[type=time],input[type=date],input[type=datetime],input[type=datetime-local],input[type=tel],input[type=number],input[type=search],textarea.materialize-textarea
		{
  background-color: transparent;
  border: none;
  border-bottom: 1px  solid #000;
  border-radius: 0;  
  outline: none;
  font-style: normal;
  font-family: initial;  
  font-size: 1rem;
  margin: 0 0 -42px 0;
  padding: 0;
  box-shadow: none;
  box-sizing: content-box;
  transition: all 0.3s;
}
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
			</style><style type="text/css">* { margin:0; padding:0; }
body { background:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:20px; }
#extra {text-align: right; font-size: 22px; width:250px; font-weight: 700}
.invoice-wrap { width:700px; margin:0 auto; background:#FFF; color:#000 }
.invoice-inner { margin:0 15px; padding:20px 0 }
.invoice-address { margin: 10px 23px;
    padding-top: 0px; }
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
<form action="<?php $PHP_SELF ?>" method="post">

<table border="0" cellpadding="0" cellspacing="0" width="93%" style="margin:-1px 23px;">
	<tbody>
		<tr>
			<td align="left" valign="top"><img class="editable-area" height="70" id="logo" src="img/logo.png" width="70" /></td>
			<td align="right" valign="top"><p><b>CODING HANDS INFOTECH LLP</b><br>4th Floor , Emarald Mall<br>Calicut-673004<br>Kerala, India<br>0495 3061234 <br>www.codinghands.in<br></p></td></tr>

            </td>
		</tr>
	</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="10" width="100%">
<tbody>

        <tr><td align="center" valign="top"><b><font size="+2">Cash Receipt</font></b></td></tr>
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
						<td style="" valign="top" width=""><strong><span class="editable-text" id="label_bill_to">Receipt No</span></strong></td>
						<td valign="top">
						<div class="client_info">
						<table border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td style="padding-left:25px;"><span class="editable-area" id="client_info"><?php echo $recno ?> <br /></span></td>
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
						<td align="right"><strong><span class="editable-text" id="label_date">Date  :</span></strong></td>
						<td align="left" style="padding-left:20px"><span class="editable-text" id="date"><?php echo $date;?></span></td>
					</tr>
					
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</div>

<div class="input-field col s2" style="font-size:15px;font-style: normal;font-family: initial;margin-left: 4%;margin-top:5%;margin-right: 5%;">

<p>Cash Receipt from &nbsp; &nbsp;&nbsp; <input type="text" name="from" class="input-field col s2" value="<?php echo $from; ?>"> &nbsp;&nbsp; of &nbsp;<input type="text" name="amount" class="input-field col s2" value="<?php echo $amount; ?>"></p>	<br><p>For &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="purpose" class="input-field col s2" value="<?php echo $purpose; ?>"></p><br>
<div class="row"><div class="col s6">
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="left">
	<tbody>
	<tr><td><p><label for="cash">Cash</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="mode" id="cash" value="Cash" class="input-field  col s2" <?php echo($mode=="Cash")?"checked":""; ?> ></p></td></tr>
    <tr><td><p><label for="Cheque">Cheque</label>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="mode" id="Cheque" value="Cheque" class="input-field col s2" <?php echo($mode=="Cheque")?"checked":""; ?>></p></td></tr>
    <tr><td><p><label for="other">Other</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="mode" value="Other" id="other" class="input-field col s2" <?php echo($mode=="Other")?"checked":""; ?>></p></td></tr>
       </tbody>
    </table>
</div>
<div class="col s6"><div id="items-list"><table class="table table-bordered table-condensed table-striped items-table">
<tbody>
<tr><td><label for="total">Total Amount Due</label></p></td><td>&nbsp;&nbsp;&nbsp;<?php echo $total; ?></td></tr>
    <tr><td><label for="total">Amount Received</label></td><td>&nbsp;&nbsp;&nbsp;<?php echo $amount; ?></td></tr>
    <tr><td><label for="total">Balance</label></p></td><td>&nbsp;&nbsp;&nbsp;<?php echo $balance; ?></td></tr>
    </tbody>
    </table>
</div>
</div>

</div>

<table border="0" cellpadding="0" cellspacing="10" align="right">
				<tbody>
					
					<tr >
						<td align="right"><strong><span class="editable-text" id="label_date"><input type="text" name="from" class="input-field col s2" ></span></strong></td>
						</tr>
					<tr >
						<td align="center"><strong><span class="editable-text" id="label_date"><label>Signature</label></span></strong></td>
						</tr>
				</tbody>
                </table>

<br />
<br />
<br />
<br />
<br />
&nbsp;</div>

</form>
</div>
		</div>
	<style>
body {
    background: #EBEBEB;
}
.invoice-wrap {box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); margin-bottom: 20px; }
#mobile-preview-close a {
position:fixed; 
left:20px; 
bottom:30px; 
background-color:#06F;
font-weight: 600;
outline: 0 !important;
line-height: 1.5;
border-radius: 3px;
font-size: 14px;
padding: 7px 10px;
border:1px solid #27c24c;
text-decoration:none;
color:#FFF !important;
}
#mobile-preview-close img {
	width:20px;
	height:auto;
}
#mobile-preview-close a:nth-child(2) {
left:100px;
background:#06F;
border:1px solid #9f9f9f;
color:#FFF !important;
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
.invoice-wrap {box-shadow: none; margin-bottom: 0px;}
html, body 
 {
	background: none;
    width: 210mm;
    height: 297mm;
	margin:0 0 0 0;
  }
}
@page {
        
        margin: 0;
    }
	
</style>

<div id="mobile-preview-close">
<a  href="javascript:window.print();">Print </a>
<a  href="bills.php">  back </a>
</div>

<script type="text/javascript">
var beforePrint = function() {
};

/*var afterPrint = function() {
	document.location.href='index.php';
};*/

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


</script></body>
</html>
