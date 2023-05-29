<?php
$server_name = "localhost";
$username = "root";
$password = ""; 
$database_name = "wt";

$conn = mysqli_connect($server_name, $username, $password, $database_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_query = "SELECT * FROM signup WHERE email = '$email' AND passs = '$password'";
    $result = mysqli_query($conn, $sql_query);

    if (mysqli_num_rows($result) == 1) {
        
        echo "Login successful!";
        header("Location: home.html");
    } else {
        $_SESSION['error_message'] = "Invalid email or password!";
        header("Location: miniprojectlogin.html"); 
        exit();
    }
}
?>