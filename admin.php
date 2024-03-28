<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><?php
include("connection.php");

// Function to handle image deletion
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Retrieve the file name to delete from the database
    $delete_query = "SELECT file FROM images WHERE id = $delete_id";
    $result = mysqli_query($con, $delete_query);
    $row = mysqli_fetch_assoc($result);
    $file_to_delete = $row['file'];
    
    // Delete the record from the database
    $delete_query = "DELETE FROM images WHERE id = $delete_id";
    mysqli_query($con, $delete_query);

    // Delete the file from the server
    unlink("images/".$file_to_delete);

    // Redirect to avoid resubmission on refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bridge for Youth Innovation</title>
  <link rel="icon" href="<?php echo $path_to_logo = "images/logo.png";?>" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar">
  <div class="container-flui">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" alt="Hangahub" width="30" height="30" class="d-inline-block align-top" color="white"><p style="color:beige;"> Bridge for Youth Innovation </p>
    </a>
    <div class="navbarNav">
      <a class="nav-link active" aria-current="page" href="index.php" onclick="toggleSignup()">Home</a>
      <a class="nav-link" href="#" onclick="toggleSignup()"></a>
      <a class="nav-link" href="index.php" onclick="toggleLogin()">Logout</a> <!-- Added Login link -->
    </div>
  </div>
</nav>
<div class="container-fluid">
<section class="section-one">
    <div class="welc" style="margin-left: 15rem;">
    <h1 style="margin-left: 10rem;" text-center>Welcome here as an Admin</h1>
   
    <h3>Here are all project ideas for the youth visiting Musanze Hangahub
      Its your time to connect them with supporters </h3> 
</div>
 
    <?php
    $res = mysqli_query($con, "SELECT * FROM images");
    while($row = mysqli_fetch_assoc($res)){
    ?>
    <img src="images/<?php echo $row['file']?>"  style="display: inline; margin-left: 10rem;"/>
    <!-- Add edit and delete buttons -->
    <a href="?delete_id=<?php echo $row['id']; ?>" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128); font-weight: 400; border-radius: 10px; text-decoration: none;margin-left: 3rem;">Delete</a>
    <form method="POST" enctype="multipart/form-data" style="display: inline; margin-left: 10rem;">
        <!-- <input type="file" name="image"/> -->
        <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
        <!-- <button type="submit" name="update">Edit</button> -->
    </form>
    <div class="dis" style=" margin-left:  6rem;">
    <p><strong style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Project owner:</strong> <?php echo $row['name']; ?></p>
    <p><strong style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Description:</strong> <?php echo $row['description']; ?></p>
    <?php }?>
</div>
  
</section>
</div>
<footer class="footer">
  <div class="container text-center">
    <p>&copy; 2024 Hangahub Musanze. All Rights Reserved.</p>
  </div>
</footer>
</body>
</html>