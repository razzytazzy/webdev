<?php
session_start();
  include_once 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>ADEV Ventures Ordering System : Login</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .error{
            background: #DCDCDC;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 10px;
            border:none; 
        }
        
    </style>

</head>
<body>
<?php

try{
	 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['login'])) {
    	$loginid = $_POST['loginid'];
  		$loginpass = $_POST['loginpass'];

  		if(empty($loginid) && empty($loginpass)){
			header("Location: login.php?error=Email and Password is required");
			exit();
		}
		else if (empty($loginpass)) {
			header("Location: login.php?error=Password is required");
			exit();

		}
		else if (empty($loginid)) {
			header("Location: login.php?error=Email is required");
			exit();

		}
		else{

			$query = "SELECT * FROM tbl_staffs_a170937_final WHERE fld_staff_email = :loginid AND fld_staff_password = :loginpass";

			$statement = $conn->prepare($query);
			$statement->execute(
					array(
						'loginid' => $_POST["loginid"],
						'loginpass' => $_POST["loginpass"]
							));
			$result = $statement->fetchAll();
			$count = $statement->rowCount();

			if ($count > 0)
			{
				$_SESSION["Loginuser"]= $_POST["loginid"];

				foreach($result as $readrow) {
				$_SESSION["user_level"]= $readrow["fld_staff_userlevel"];
				$_SESSION["Loginame"]= $readrow["fld_staff_name"];
				}
				header("location:index.php");
			}
			else{
				header("Location: login.php?error=Email or Password invalid");
			exit();
			}
		}
    }
}
catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }
?>
	<div class="container-fluid">
	  <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        	<center><h1>ADEV Ventures Sdn Bhd</h1></center>
        	<center><img src="logo.jpg" width="50%" height="50%"></center>
            <form method="post" class="form-horizontal">
        	   <div class="page-header">
        		<center><h2>Login</h2></center>
        	   </div>
                <div class="form-group">
                <center><?php if (isset($_GET['error'])){?>
                <label class="error"><?php echo $_GET['error'];?></p>
                <?php } ?></center>
                </div>
        	
        		<div class="form-group">
        			<label for="loginid" class="col-sm-3 control-label">Email</label>
        			<div class="col-sm-9">
        			<input name="loginid" type="text" class="form-control" id="loginid" placeholder="Enter Email">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="loginpass" class="col-sm-3 control-label">Password</label>
        			<div class="col-sm-9">
        			<input name="loginpass" type="password" class="form-control" id="loginpass" placeholder="Enter Password">
        			</div>
        		</div>
        		<div class="form-group">
        			<div class="col-sm-offset-3 col-sm-9">
        			<center><button class="btn btn-default" type="submit" name="login"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login</button></center>
        			</div>
        		</div>
        	</form>
		</div>
	  </div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>