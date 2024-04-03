<?php
// Include database connection file
include("connection.php");

// Retrieve user ID from URL parameter
$user_id = $_GET['id'];

// Fetch user details from database
$query = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Handle form submission to update user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $names = $_POST['names'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Perform SQL update to edit the user
    $update_query = "UPDATE user SET names='$names', email='$email', role='$role' WHERE id=$user_id";
    if (mysqli_query($con, $update_query)) {
        header("Location: admin.php"); // Redirect back to the admin page
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Same as add_user.php -->
</head>
<body>

<div class="container">
    <h2>Edit User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $user_id); ?>">
        <div class="form-group">
            <label for="names">Names:</label>
            <input type="text" class="form-control" id="names" name="names" value="<?php echo $row['names']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" id="role" name="role" value="<?php echo $row['role']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
