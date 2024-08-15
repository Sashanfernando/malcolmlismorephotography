<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';
$type_of_job = isset($_POST['type_of_job']) ? $_POST['type_of_job'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';


if (empty($contact_no) || empty($type_of_job) || empty($date)) {
    echo "Please fill in all required fields.";
    exit;
}


$id = $_POST['id'];
$name = $_POST['name'];
$contact_no = $_POST['contact_no'];
$type_of_job = $_POST['type_of_job'];
$date = $_POST['date'];
$time = $_POST['time'];
$package = $_POST['package'];
$email = $_POST['email'];
$location = $_POST['location'];


$sql = "INSERT INTO enquiries (id, name, contact_no, type_of_job, date, time, package, email, location)
VALUES ('$id', '$name', '$contact_no', '$type_of_job', '$date', '$time', '$package', '$email', '$location')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>

