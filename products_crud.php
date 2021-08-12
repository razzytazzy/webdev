<?php
 
include_once 'database.php';
?>
<?php
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
  $target_dir = "products/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["create"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } 
    else {
      echo "<script type='text/javascript'>alert('File is not an image. ');</script>";
      $uploadOk = 0;
    }
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "<script type='text/javascript'>alert('Sorry, your file is too large. ');</script>";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "gif") {
    echo "<script type='text/javascript'>alert('Sorry, only GIF files are allowed. ');</script>";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } 
  else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

      try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a170937_final(fld_product_num,
        fld_product_name, fld_product_price, fld_product_series, fld_product_color,
        fld_product_size, fld_product_weight, fld_product_image) VALUES(:pid, :name, :price, :series,
        :color, :size, :weight, :image)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':series', $series, PDO::PARAM_STR);
      $stmt->bindParam(':color', $color, PDO::PARAM_STR);
      $stmt->bindParam(':size', $size, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
      $stmt->bindParam(':image', $image, PDO::PARAM_STR);

       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $series =  $_POST['series'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $weight = $_POST['weight'];
    $image = $_FILES["fileToUpload"]["name"];

     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
}}


//Update
if (isset($_POST['update'])) {
  $target_dir = "products/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } 
    else {
      echo "<script type='text/javascript'>alert('File is not an image. ');</script>";
      $uploadOk = 0;
    }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "<script type='text/javascript'>alert('Sorry, your file is too large. ');</script>";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "gif") {
    echo "<script type='text/javascript'>alert('Sorry, only GIF files are allowed. ');</script>";;
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } 
  else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

      try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a170937_final SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_series = :series,
        fld_product_color = :color, fld_product_size = :size, fld_product_weight = :weight, fld_product_image = :image
        WHERE fld_product_num = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':series', $series, PDO::PARAM_STR);
      $stmt->bindParam(':color', $color, PDO::PARAM_STR);
      $stmt->bindParam(':size', $size, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
      $stmt->bindParam(':image', $image, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $series =  $_POST['series'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $weight = $_POST['weight'];
    $image = $_FILES['fileToUpload']['name'];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
}
}
  

//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a170937_final WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a170937_final WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>