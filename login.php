<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($Email) && !empty($password)) {
        $Email = mysqli_real_escape_string($con, $Email);
        $query = "SELECT * FROM user WHERE Email = '$Email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($password, $user_data['password'])) {
                $role = $user_data['role'];

                if ($role === 'user') {
                    $_SESSION['user_id'] = $user_data['id'];
                    header("Location: user.php");
                    exit();
                } elseif ($role === 'admin') {
                    $_SESSION['admin_id'] = $user_data['id'];
                    header("Location: adm.php");
                    exit();
                }
                elseif ($role === 'educator') {
                    $_SESSION['admin_id'] = $user_data['id'];
                    header("Location: ed.php");
                    exit();
                }
            } else {
                echo "Incorrect password!";
                echo "<br>Password from form: $password";
                echo "<br>Hashed password from database: " . $user_data['password'];
            }
        } else {
            echo "User not found!";
        }
    } else {
        echo "Please enter both email and password!";
    }
}
?>
