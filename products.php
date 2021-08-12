<?php
  session_start();
  if (!isset($_SESSION['Loginuser'])) {
    header('location:login.php');
  }
?>
<?php
  include_once 'products_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>ADEV Ventures Ordering System : Products</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      body{
        background: #DCDCDC;
      }
    </style>
</head>
<body>
  
    <?php include_once 'nav_bar.php'; ?>

    <div class="container-fluid">
      <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>

    <form action="products.php" method="post" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">Product ID</label>
          <div class="col-sm-9">
      <input name="pid" type="text" class="form_control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>
      </div>
        </div>
      <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
      </div>
        </div>
        <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
      <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required>
      </div>
        </div>
      <div class="form-group">
          <label for="productseries" class="col-sm-3 control-label">Series</label>
          <div class="col-sm-9">
      <select name="series" class="form-control" id="productseries" required>
        <option value="">Please select</option>
        <option value="METOD" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="METOD") echo "selected"; ?>>METOD</option>
        <option value="VADHOLMA" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="VADHOLMA") echo "selected"; ?>>VADHOLMA</option>
        <option value="STENSTORP" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="STENSTORP") echo "selected"; ?>>STENSTORP</option>
        <option value="TORNVIKEN" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="TORNVIKEN") echo "selected"; ?>>TORNVIKEN</option>
        <option value="BEKVAM" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="BEKVAM") echo "selected"; ?>>BEKVAM</option>
        <option value="MASTERBY" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="MASTERBY") echo "selected"; ?>>MASTERBY</option>
        <option value="KUNGSFORS" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="KUNGSFORS") echo "selected"; ?>>KUNGSFORS</option>
        <option value="BODBYN" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="BODBYN") echo "selected"; ?>>BODBYN</option>
        <option value="VOXTORP" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="VOXTORP") echo "selected"; ?>>VOXTORP</option>
        <option value="BODARP" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="BODARP") echo "selected"; ?>>BODARP</option>
        <option value="MAXIMERA" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="MAXIMERA") echo "selected"; ?>>MAXIMERA</option>
        <option value="EKBACKEN" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="EKBACKEN") echo "selected"; ?>>EKBACKEN</option>
        <option value="SALJAN" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="SALJAN") echo "selected"; ?>>SALJAN</option>
        <option value="KARLBY" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="KARLBY") echo "selected"; ?>>KARLBY</option>
        <option value="KNOXHULT" <?php if(isset($_GET['edit'])) if($editrow['fld_product_series']=="KNOXHULT") echo "selected"; ?>>KNOXHULT</option>
      </select>
      </div>
        </div>    
        <div class="form-group">
          <label for="productcolor" class="col-sm-3 control-label">Color</label>
          <div class="col-sm-9">
            <label>
      <input name="color" type="text" class="form-control" id="productcolor" placeholder="Product Color" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_color']; ?>" required>
      </div>
        </div>  
      <div class="form-group">
          <label for="productsize" class="col-sm-3 control-label">Size(WxDxH)</label>
          <div class="col-sm-9">
      <input name="size" type="text" class="form-control" id="productsize" placeholder="Product Size" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_size']; ?>" required>
      </div>
        </div>  
      <div class="form-group">
          <label for="productweight" class="col-sm-3 control-label">Weight(kg)</label>
          <div class="col-sm-9">
      <input name="weight" type="text" class="form-control" id="productweight" placeholder="Product Weight" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_weight']; ?>" required>
      </div>
      </div>
      <div class="form-group">
        <label for="productimage" class="col-sm-3 control-label">Image</label>
        <div class="col-sm-9">
          <input type="file" name="fileToUpload" class="form-control-file" id="image" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_image']; ?>" required>Only GIF format with max 10MB.
        </div>
      </div> 
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else if($_SESSION['user_level']=='Admin'){?>
      <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } else if($_SESSION['user_level']=='Normal Staff'){?> 
      <button class="btn btn-default" type="submit" name="create" disabled><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
      </div>
      </div>
    </form>
    </div>
  </div>
    
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">

      <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Series</th>
        <th>Color</th>
        <th>Size(WxDxH)</th>
        <th>Weight(kg)</th>
        <th>Image</th>
        <th></th>
      </tr>
      <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a170937_final LIMIT $start_from, $per_page");
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
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_product_series']; ?></td>
        <td><?php echo $readrow['fld_product_color']; ?></td>
        <td><?php echo $readrow['fld_product_size']; ?></td>
        <td><?php echo $readrow['fld_product_weight']; ?></td>
        <td><?php echo $readrow['fld_product_image']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <?php if($_SESSION['user_level']=='Admin'){?>
          <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          <?php } else if($_SESSION['user_level']=='Normal Staff'){?>
          <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button" disabled> Edit </a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button" disabled>Delete</a>
        <?php } ?>
        </td>
      </tr>
      <?php } ?>
 
    </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a170937_final");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>

    </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>