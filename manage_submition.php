<?php
session_start();
include("connection.php");
include("functions.php");

// Retrieve all uploaded videos from the database
$query = "SELECT * FROM user_videos";
$result = mysqli_query($con, $query);



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
      <a class="nav-link active" aria-current="page" href="index.php" >Home</a>
      <a class="nav-link" href="adm.php" onclick="toggleSignup()">Back</a>
     
    </div>
  </div>
</nav>

<div class="container-fluid">
    <section class="section-one">
        <div class="video-pair-container">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="video-pair">
                <div class="video-wrapper">
                    <h3><?php echo ucfirst($row['level']); ?> Level</h3>
                    <video controls>
                        <source src="<?php echo $row['filepath']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="video-info">
                    <div>
                        <p class="task-description">Video Name: <?php echo $row['video_name']; ?></p>
                        <p>Names: <?php echo $row['uploader_name']; ?></p>
                        <p>Description: <?php echo $row['description']; ?></p>
                        <p>Uploaded at: <?php echo $row['uploaded_at']; ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <section class="section-feedback">
    <div class="container">
        
    </div>
</section>
</div>

<!-- Feedback Form -->


<footer class="footer">
    <div class="container text-center">
        <p>&copy; 2024 YCSPOut. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
