<?php
  session_start();
  if (!isset($_SESSION['Loginuser'])) {
    header('location:login.php');
  }
?>
<?php
  include_once 'database.php'; 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>ADEV Ventures Ordering System : Search</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    	#searching{
    		width: 80%;
        	padding: 12px 20px;
        	margin: 10px 0px 10px 0px;
        	box-sizing: border-box;
        	font: 100% Lucida Sans, Verdana;
    	}
      body{
        background: #DCDCDC;
      }
    </style>
</head>
<body>
	<?php include_once 'nav_bar.php'; ?>

	<div class="container-fluid">
		<div class="page-header">
        	<center><h2>Search</h2></center>
        </div>
        <form method="post" class="form-horizontal" action="search.php">
        	<div class="form-group">
        		<center><input type="text" name="search" id="searching" placeholder="Product Series, Product Color, Product Size, eg: Metod White 80x60x80"></center>
        	</div>
        	<div class="form-group">
        		<center><button type="submit" id="searchbtn" name="searchbtn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>Search</button></center>
        	</div>
		</form>
	</div>
	
	<?php 
		$fkey="";
		$skey="";
		$tkey="";

		if(isset($_POST['searchbtn'])){
  			if($_POST['search']!=""){
   	 			$searching=$_POST['search'];
    			$pieces=explode(" ",$searching);
    			if(count($pieces)==3){
 					$fkey=$pieces[0];
    				$skey=$pieces[1];
    				$tkey=$pieces[2];
	?>

	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
		<table class="table table-striped table-bordered" id="my" >
			<tr>
				<th>Product ID</th>
          		<th>Name</th>
          		<th>Series</th>
          		<th>Color</th>
          		<th>Size</th>
          		<th></th>
			</tr>

			<?php

      		try {
        		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         		$stmt = $conn->prepare("SELECT * FROM tbl_products_a170937_final WHERE fld_product_series like '%$fkey%' AND fld_product_color like '%$skey%' AND fld_product_size like '%$tkey%'");
       			$stmt->execute();
        		$result = $stmt->fetchAll();
      		}
      		catch(PDOException $e){
            	echo "Error: " . $e->getMessage();
      		}
      		foreach($result as $readrow) {
      		?> 
           <tr>
        	<td><?php echo $readrow['fld_product_num']; ?></td>
        	<td><?php echo $readrow['fld_product_name']; ?></td>
        	<td><?php echo $readrow['fld_product_series']; ?></td>
        	<td><?php echo $readrow['fld_product_color']; ?></td>
        	<td><?php echo $readrow['fld_product_size']; ?></td>
        	<td>
          	<a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          	</td>
      		</tr>
      		<?php
      		}
      		$conn = null;
      		?>
		</table>
		</div>
	</div>
	<?php
}else

echo "<script type='text/javascript'>alert('Please Enter 3 Keywords. ');</script>";

  }else
  
  echo "<script type='text/javascript'>alert('Please Enter a Keyword to Search.');</script>";

}
?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>