<?php
session_start();
include("connection.php");
include("functions.php");

// Retrieve feedback from the database if the "Get Feedback" link is clicked
if(isset($_GET['get_feedback'])) {
    $query = "SELECT * FROM feedback";
    $result = mysqli_query($con, $query);
}

ini_set('upload_max_filesize', '100M');
// Set maximum post data size
ini_set('post_max_size', '100M');

// Function to handle video deletion and task
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Retrieve the filename and filepath from the database
    $delete_query = "SELECT filename, filepath FROM user_videos WHERE id = $delete_id";
    $result = mysqli_query($con, $delete_query);
    $row = mysqli_fetch_assoc($result);
    $filename_to_delete = $row['filename'];
    $filepath_to_delete = $row['filepath'];

    // Delete the record from the database
    $delete_query = "DELETE FROM user_videos WHERE id = $delete_id";
    mysqli_query($con, $delete_query);

    // Delete the file from the server
    unlink($filepath_to_delete);

    // Redirect to avoid resubmission on refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Function to handle video addition and task
if(isset($_POST['submit'])) {
    $level = $_POST['level'];
    $video_name = $_POST['video_name'];
    $uploader_name = $_POST['your_name'];
    $description = $_POST['video_description'];
    $file_name = $_FILES['video']['name'];
    $tempname = $_FILES['video']['tmp_name'];
    $folder = 'videos/'.$file_name;

    // Insert the record into the database
    $stmt = $con->prepare("INSERT INTO user_videos (level, video_name, uploader_name, description, filename, filepath) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $level, $video_name, $uploader_name, $description, $file_name, $folder);
    $stmt->execute();
    $stmt->close();

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
      <a class="nav-link" href="?get_feedback=true" onclick="toggleSignup()">Get Feedback</a> <!-- Link to get feedback -->
      <a class="nav-link" href="index.php" onclick="toggleLogin()">Logout</a> <!-- Added Login link -->
    </div>
  </div>
</nav>
<div class="container-fluid">
<section class="section-one">
   <div style="margin-left: 25rem;">
   <h1>Welcome to your working space!</h1> 
   <h3 style="margin-left: 2rem; background-color: rgb(236, 228, 228);">It's time to show what you've learned at the level you covered</h3>
   <p style="margin-left: 2.5rem; background-color: rgb(236, 228, 228);">Believe that you can stand on your own and speak to the world</p>
   <form method="POST" enctype="multipart/form-data" style="margin-left: -10rem;">
   <label for="level">Level:</label>
        <select name="level" id="level">
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select><br><br>
        <label for="videoname">Name of video:</label>
        <input type="text" name="video_name" id="videoname"><br><br>
        <label for="video">Select Video:</label>
        <input type="file" name="video" id="video" accept="video/*"><br><br>
    <label for="your_name" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;background-color: rgb(236, 228, 228);">Your Name:</label>
    <input type="text" id="your_name" name="your_name"  style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;"><br><br>
    <label for="image_description" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;background-color: rgb(236, 228, 228);">Video Description (Max 30000 characters, remember to include your Email address):</label><br>
    <textarea id="video_description" name="video_description" rows="4" cols="50" maxlength="30000" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;"></textarea><br><br>
    <button type="submit" name="submit" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128);border-radius: 10px; font-weight: 400; margin-right: -1000px;">Submit</button>
   </form>
   </div>
</section>

<?php if(isset($result)): ?>
<section class="feedback-section">
    <h2>Feedback</h2>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="feedback-item">
            <p><strong>Educator Name:</strong> <?php echo $row['educator_name']; ?></p>
            <p><strong>Feedback:</strong> <?php echo $row['feedback']; ?></p>
        </div>
    <?php endwhile; ?>
</section>
<?php endif; ?>

</div>

<footer class="footer">
  <div class="container text-center">
    <p>&copy; 2024 YCSPOut. All Rights Reserved.</p>
  </div>
</footer>
</body>
</html>
