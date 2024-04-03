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
    $level = $_POST['level'];

    // Update the record in the database
    $update_query = "UPDATE learn SET filename='$file_name', filepath='$folder', task='$task', level='$level' WHERE id=$update_id";
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

  <style>
        /* CSS for displaying videos in pairs */
        .video-pair-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .video-pair {
            display: flex;
            flex-wrap: wrap;
            width: calc(50% - 20px); /* Set width to 50% with margin */
            margin-bottom: 20px;
        }

        .video-wrapper {
            width: calc(50% - 20px); /* Set width to 50% with margin */
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .video-wrapper video {
            width: 100%; /* Make the video fill the container */
            height: auto; /* Maintain aspect ratio */
        }

        .video-info {
            background-color: rgba(207, 235, 235, 0.5);
            padding: 10px;
            margin-top: 10px;
        }
        .task-description {
    font-size: 1.8rem; 
    font-weight: initial; 


    
}

form {
            margin-bottom: 0.2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            padding-left: 0.2rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 30%;
            padding: 1rem;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        /* CSS for the buttons */
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }


    </style>







</head>
<body>
<nav class="navbar">
  <div class="container-flui">
    <a class="navbar-brand" href="#">
      <img src="images/log.png" alt="ycp" width="50" height="50" class="d-inline-block align-top"><p style="color:beige;">You Can Speak Out</p>
    </a>
    <div class="navbarNav" style="margin-left: 900px; margin-right: 100px;" >
      <a class="nav-link active" aria-current="page" href="index.php" >Home</a>
      <a class="nav-link" href="submition.php">Students' submitions</a>
      <a class="nav-link" href="index.php">Logout</a> 
      
    </div>
  </div>
</nav>
<div class="container-fluid">

<header class="jumbotron">
    <h2>Welcome Instructor or Educator to YCSPout Platform .</h2>
    <p style="font-size:1.5rem; font-style: italic;  background-color: rgb(236, 228, 228);" >Your support is important to improve public speaking skills for rural area students.</p>
  </header>
   <form method="POST" enctype="multipart/form-data">
        <label for="level">Level:</label>
        <select name="level" id="level">
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="advanced">Advanced</option>
        </select><br><br>
        <label for="task">Task Description:</label>
        <input type="text" name="task" id="task"><br><br>
        <label for="video">Select Video:</label>
        <input type="file" name="video" id="video" accept="video/*"><br><br>
        <input type="submit" value="Upload" name="submit">
   </form>

   <div>
   <div class="video-pair-container">
    <?php
    $res = mysqli_query($con, "SELECT * FROM learn");
    while($row = mysqli_fetch_assoc($res)){
    ?>
    <div class="video-pair">
    <div class="video-wrapper">
    <h3><?php echo ucfirst($row['level']); ?> Level</h3>
    <video controls>
        <source src="<?php echo $row['filepath']?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
  </div>
  <div class="video-info">
    <div style="padding-left: 150px; ">
        <p  class="task-description"><?php echo $row['task']; ?></p>
        <p style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Uploaded at: <?php echo $row['aploaded_at']; ?></p>
        <!-- Add edit and delete buttons  -->
        <a href="?delete_id=<?php echo $row['id']; ?>" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128); font-weight: 400; border-radius: 10px; text-decoration: none;">Delete</a>
        <form  style="display: inline; margin-top: 200px; " method="POST" enctype="multipart/form-data" style="display: inline; margin-top: 200px; ">
            <input  style="display: inline; margin-top: 20px; " type="file" name="video" accept="video/*"/>
            <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
            <label for="task" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Task :</label>
            <input type="text" name="task" id="task" value="<?php echo $row['task']; ?>"><br><br>
            <label for="level" style="font-size: 1.5rem; color:rgb(24, 23, 23); font-weight: 400;">Level:</label>
            <select name="level" id="level">
                <option value="beginner" <?php echo ($row['level'] == 'beginner') ? 'selected' : ''; ?>>Beginner</option>
                <option value="intermediate" <?php echo ($row['level'] == 'intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                <option value="advanced" <?php echo ($row['level'] == 'advanced') ? 'selected' : ''; ?>>Advanced</option>
            </select><br><br>
            <button type="submit" name="update" style="font-size: 1.5rem; color:white; background-color: rgb(11, 128, 128); font-weight: 400; border-radius: 10px; text-decoration: none;">Edit</button>
        </form>
      </div>
    </div>
    </div>
    <?php }?>
  </div>
   </div>
   </div>

   <footer class="footer">
  <div class="container text-center">
    <p>&copy; 2024 YCSPOut.Empowering Rural Students to Speak Out. All Rights Reserved.</p>
  </div>
</footer>
</body>
</html>
