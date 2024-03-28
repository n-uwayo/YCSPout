<?php
include("connection.php");

// Function to handle image deletion


// Function to handle image update


// Function to handle image addition
if(isset($_POST['submit'])) {
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/'.$file_name;
    $image_name = $_POST['image_name'];
    $image_description = $_POST['image_description'];

    // Insert the record into the database
    $query = mysqli_query($con, "INSERT INTO images (file, name, description) VALUES ('$file_name', '$image_name', '$image_description')");

    // Move the uploaded file to the server
    move_uploaded_file($tempname, $folder);

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
    <title>YCSPOut</title>
  <link rel="icon" href="<?php echo $path_to_logo = "images/log.png";?>" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar">
  <div class="container-flui">
    <a class="navbar-brand" href="#">
      <img src="images/log.png" alt="ycspout" width="30" height="30" class="d-inline-block align-top"><p style="color:beige;">You Can Speak Out</p>
    </a>
    <div class="navbarNav">
      <a class="nav-link active" aria-current="page" href="index.php" onclick="toggleSignup()">Home</a>
      <a class="nav-link" href="dispUser.php" onclick="toggleSignup()">My account</a>
      <a class="nav-link" href="index.php" onclick="toggleLogin()">Logout</a> <!-- Added Login link -->
    </div>
  </div>
</nav>
<div class="container-fluid">
<section class="section-one">
   <div style=" margin-left:  25rem;">
   <h1>Welcome to your working space!</h1> 
   <h3 style=" margin-left:  2rem; background-color: rgb(236, 228, 228);">It time to now what you have learnt on level you covered</h3>
   <p style=" margin-left:  2.5rem; background-color: rgb(236, 228, 228);">Believe that you can stand on yourself and talk to world</p>
   <form method="POST" enctype="multipart/form-data" style=" margin-left:  -10rem;">
    <h2>Please take 3-5 min video to apply skills you have gained from the level you have covered </h2>
    <input type="file" name="image" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;"/><br><br>
    <label for="image_name" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;background-color: rgb(236, 228, 228);">Your Name:</label>
    <input type="text" id="image_name" name="image_name"  style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;"><br><br>
    <label for="image_description" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;background-color: rgb(236, 228, 228);">video Description (Max 30000 characters including your phone number):</label><br>
    <textarea id="image_description" name="image_description" rows="4" cols="50" maxlength="30000"style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;" ></textarea><br><br>
    <button type="submit" name="submit" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128);border-radius: 10px; font-weight: 400; margin-right: -1000px;">Submit</button>
   </form>

   
   </div>
</section>
</div>
<footer class="footer">
  <div class="container text-center">
    <p>&copy; 2024 YCSPOut. All Rights Reserved.</p>
  </div>
</footer>
</body>
</html>
