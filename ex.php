<?php
// Include the database connection file
session_start();
include("connection.php");
include("functions.php");

ini_set('upload_max_filesize', '100M');
// Set maximum post data size
ini_set('post_max_size', '100M');

// Function to handle video deletion and task
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Retrieve the filename, filepath, and task from the database
    $delete_query = "SELECT filename, filepath FROM learn WHERE id = $delete_id";
    $result = mysqli_query($con, $delete_query);
    $row = mysqli_fetch_assoc($result);
    $filename_to_delete = $row['filename'];
    $filepath_to_delete = $row['filepath'];

    // Delete the record from the database
    $delete_query = "DELETE FROM learn WHERE id = $delete_id";
    mysqli_query($con, $delete_query);

    // Delete the file from the server
    unlink($filepath_to_delete);

    // Redirect to avoid resubmission on refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Function to handle video update and task
if(isset($_POST['update'])) {
    $update_id = $_POST['update_id'];
    $file_name = $_FILES['video']['name'];
    $tempname = $_FILES['video']['tmp_name'];
    $folder = 'videos/'.$file_name;
    $task = $_POST['task'];

    // Update the record in the database
    $update_query = "UPDATE learn SET filename='$file_name', filepath='$folder', task='$task' WHERE id=$update_id";
    mysqli_query($con, $update_query);

    // Move the uploaded file to the server
    move_uploaded_file($tempname, $folder);

    // Redirect to avoid resubmission on refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Function to handle video addition and task
if(isset($_POST['submit'])) {
    $level = $_POST['level'];
    $task = $_POST['task'];
    $file_name = $_FILES['video']['name'];
    $tempname = $_FILES['video']['tmp_name'];
    $folder = 'videos/'.$file_name;

    // Insert the record into the database
    $stmt = $con->prepare("INSERT INTO learn (level, task, filename, filepath) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $level, $task, $file_name, $folder);
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
  <title>YCSPout</title>
  <link rel="icon" href="<?php echo $path_to_logo = "images/log.png";?>" type="image/png">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z1s/JmLXaut9tPIGhclksx5qKGCDLIpuU1xJ2h" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="index.css">
</head>
<body>
<nav class="navbar">
  <div class="container-flui">
    <a class="navbar-brand" href="#">
      <img src="images/log.png" alt="ycp" width="50" height="50" class="d-inline-block align-top"><p style="color:beige;">You Can Speak Out</p>
    </a>
    <div class="navbarNav" style="margin-left: 900px; margin-right: 100px;" >
      <a class="nav-link active" aria-current="page" href="#" onclick="">Home</a>
      <a class="nav-link" href="#" onclick="toggleSignup()">Signup</a>
      <a class="nav-link" href="#" onclick="toggleLogin()">Login</a> <!-- Added Login link -->
    </div>
  </div>
</nav>

<div class="container-fluid">

<header class="jumbotron">
    <h1>Welcome to YCSPout Platform Its your time to improve public speaking skills.</h1>
    <p style="font-size:1.5rem; font-style: italic;  background-color: rgb(236, 228, 228);" >From begnning level to high level of public speaking.</p>
  </header>

   <h2>Aploade videos with corresponding task</h2> 
   <form method="POST" enctype="multipart/form-data">
        <label for="level"style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Level:</label>
        <select name="level" id="level" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">
            <option value="beginner" >Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select><br><br>
        <label for="task" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Task:</label>
        <input type="text" name="task" id="task"><br><br>
        <label for="video" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Select Video:</label>
        <input  style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;" type="file" name="video" id="video" accept="video/*" ><br><br>
        <input type="submit" value="Upload" name="submit" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128); font-weight: 400; border-radius: 10px; text-decoration: none;margin-left: 3rem;">
   </form>

   <div >
    <?php
    $res = mysqli_query($con, "SELECT * FROM learn");
    while($row = mysqli_fetch_assoc($res)){
    ?>
    <video controls>
        <source src="<?php echo $row['filepath']?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div style="padding-left: 150px;  background-color: rgba(207, 235, 235, 0.5);">
    <p><?php echo $row['task']; ?></p>
    <p style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Uploaded at: <?php echo $row['aploaded_at']; ?></p>
 <!-- Display updated time -->
    <!-- Add edit and delete buttons -->
    <a href="?delete_id=<?php echo $row['id']; ?>" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128); font-weight: 400; border-radius: 10px; text-decoration: none;margin-left: 3rem;">Delete</a>
    <form method="POST" enctype="multipart/form-data" style="display: inline;">
        <input type="file" name="video" accept="video/*"/>
        <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
        <label for="task" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Task :</label>
        <input type="text" name="task" id="task" value="<?php echo $row['task']; ?>"><br><br>
        <button type="submit" name="update" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128); font-weight: 400; border-radius: 10px; text-decoration: none;margin-left: 3rem;">Edit</button>
    </form>
  </div>
    <?php }?>
   </div>
</div>


<footer class="footer">
  <div class="container text-center">
    <p>&copy; 2024 YCSPOut. All Rights Reserved.</p>
  </div>
</footer>
</body>
</html>
