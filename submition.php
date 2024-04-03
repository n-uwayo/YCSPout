<?php
session_start();
include("connection.php");
include("functions.php");

// Retrieve all uploaded videos from the database
$query = "SELECT * FROM user_videos";
$result = mysqli_query($con, $query);

// Feedback Submission 
if(isset($_POST['submit_feedback'])) {
    $educator_name = $_POST['educator_name'];
    $feedback = $_POST['feedback'];

    
    $insert_query = "INSERT INTO feedback (educator_name, feedback) VALUES ('$educator_name', '$feedback')";
    mysqli_query($con, $insert_query);
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
      <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      <a class="nav-link" href="ed.php" >Back</a>
      <a class="nav-link" href="index.php">Logout</a> 
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
        <h2>Leave Feedback</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="educator_name">Educator Name:</label>
            <input type="text" name="educator_name" id="educator_name" required><br><br>
            <label for="feedback">Feedback:</label><br>
            <textarea name="feedback" id="feedback" rows="4" cols="50" required></textarea><br><br>
            <button type="submit" name="submit_feedback">Send Feedback</button>
        </form>
    </div>
</section>
</div>




<footer class="footer">
    <div class="container text-center">
        <p>&copy; 2024 YCSPOut.Empowering Rural Students to Speak Out. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
