<!DOCTYPE html>
  <html>
    <head>
      <html>
    <head>
    <title>Coding Hands</title>
      <!--Import Google Icon Font-->
      <link rel="shortcut icon" href="img/favicon.ico" >
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

	  <style type="text/css">
	  .container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.form-login {
    max-width: 330px;
    margin: 100px auto 0;
    background: #fff;
    border-radius: 5px;
    -webkit-border-radius: 5px;
}
@media (min-width: 1200px)
.container {
    width: 1170px;
}
	  </style>
    </head>

    <body>
	<div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="<?php $PHP_SELF ?>" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="uname" placeholder="User ID" autofocus required><br>
		            <br>
		            <input type="password" class="form-control" name="pwd" placeholder="Password" required><br><br>        
		            </label>
		            <button class="btn btn-theme btn-block" type="submit" name="login"><i class="fa fa-lock"></i> SIGN IN</button>   
		            
		        </div>
		      </form>	  	
	  	<?php
		if(isset($_POST['login']))
		{
			include("config.php");
			session_start();
			$username=$_POST['uname'];
			$password=$_POST['pwd'];
			$_SESSION['NAME']=$username;
			$checkUserName="SELECT * FROM login WHERE un = '$username' and pw = '$password'";
			$userResult=mysqli_query($conn,$checkUserName) or die(mysql_error());
	
			if (mysqli_num_rows($userResult) ==0) 
				{
					
					echo '<script type="text/javascript">alert("Invalid Login!Try again");</script>';
					echo '<script>window.location.href = "login.php";</script>';
					
				} 
			else 
			{
			   
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
									exit();
			}
		}
		?>
	  	</div>
	  </div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
    </body>
  </html>