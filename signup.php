<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve data from database table
    $names = $_POST['names'];
    $Email = $_POST['Email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    if(!empty($names) && !empty($Email) && !empty($password)) {
        // Insert data into database
        $query = "INSERT INTO user (names, Email, password) VALUES ('$names', '$Email', '$hashed_password')";
        
        if(mysqli_query($con, $query)) {
			
            header("Location: user.php");
            die;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please enter some valid information!";
    }
}
?>