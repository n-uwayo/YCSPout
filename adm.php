<?php
// Check if the user is logged in

// Include database connection file
include("connection.php");

// Retrieve all users from the database
$query = "SELECT * FROM user";
$result = mysqli_query($con, $query);

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
  <link rel="stylesheet" href="styles.css">


    <style>
        /* Additional CSS for visible lines */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        button {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    color: #fff;
    background-color: green;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    margin-left: 2rem;
}
.btn-danger {
    background-color: #dc3545;
    border-color: green;
}

    </style>


</head>
<body>

<nav class="navbar">
  <div class="container-flui">
    <a class="navbar-brand" href="#">
      <img src="images/log.png" alt="ycspout" width="30" height="30" class="d-inline-block align-top"><p style="color:beige;">You Can Speak Out</p>
    </a>
    <div class="navbarNav">
      <a class="nav-link active" aria-current="page" href="index.php" onclick="toggleSignup()">Home</a>
      <a class="nav-link" href="manage_user.php">Tasks aploaded</a>
      <a class="nav-link" href="manage_submition.php" >Student Participation</a> 
      <a class="nav-link" href="index.php" onclick="toggleLogin()">Logout</a> 
    </div>
  </div>
</nav>

<div class="container">
<header class="jumbotron">
    <h2>Welcome  Admin to YCSPout Platform Its your responsibility to manage  this Platform.</h2>
  </header>
    <h2>All Users</h2>
    <button onclick="window.location.href='add_user.php'">Add User</button> <!-- Add User button -->
    <table class="table">
        <thead>
            <tr>
               <th>ID</th>
                <th>Names</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th> <!-- Added Actions column -->
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each user record and display it in a table row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['names'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>";
                echo "<button onclick=\"window.location.href='edit_user.php?id=".$row['id']."'\">Edit</button>"; // Edit button
                echo "<button class=\"btn btn-danger\" onclick=\"window.location.href='delete_user.php?id=".$row['id']."'\">Delete</button>"; // Delete button
                echo "</td>";
                // Add more columns as needed
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<footer class="footer">
  <div class="container text-center">
    <p>&copy; 2024 YCSPOut.Empowering Rural Students to Speak Out. All Rights Reserved.</p>
  </div>
</footer>

</body>
</html>
