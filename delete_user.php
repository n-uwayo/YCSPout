<?php
// Include database connection file
include("connection.php");

// Retrieve user ID from URL parameter
$user_id = $_GET['id'];

// Perform SQL deletion to delete the user
$query = "DELETE FROM user WHERE id = $user_id";
if (mysqli_query($con, $query)) {
    header("Location: adm.php"); // Redirect back to the admin page
    exit;
} else {
    echo "Error: " . mysqli_error($con);
}
?>
