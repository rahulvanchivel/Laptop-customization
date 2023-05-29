<?php
$server_name = "localhost";
$username = "root";
$password = ""; 
$database_name = "wt";

$conn = mysqli_connect($server_name, $username, $password, $database_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $mnum = $_POST['phone'];
    $pass = $_POST['password'];

    $sql_query = "INSERT INTO signup (email, fname, lname, mnum, passs)
    VALUES ('$email', '$fname', '$lname', '$mnum', '$pass')";

    if (mysqli_query($conn, $sql_query)) {
        header ("Location:./home.html"); 
    } 
    else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>