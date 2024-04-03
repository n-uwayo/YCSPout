<?php
// Include database connection file
include("connection.php");

// Handle form submission to add user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $names = $_POST['names'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Adding password field
    $role = $_POST['role'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Perform SQL insertion to add the user
    $query = "INSERT INTO user (names, email, password, role) VALUES ('$names', '$email', '$hashed_password', '$role')";
    if (mysqli_query($con, $query)) {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z1s/JmLXaut9tPIGhclksx5qKGCDLIpuU1xJ2h" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Add User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="names">Names:</label>
            <input type="text" class="form-control" id="names" name="names">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label> <!-- Adding password field -->
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" id="role" name="role">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
