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
    <title>Admin - All Users</title>
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
    </style>


</head>
<body>

<div class="container">
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
                echo "<button onclick=\"window.location.href='delete_user.php?id=".$row['id']."'\">Delete</button>"; // Delete button
                echo "</td>";
                // Add more columns as needed
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
