<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $type_of_job = $_POST['type_of_job'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $package = $_POST['package'];
    $email = $_POST['email'];
    $location = $_POST['location'];

   
    $sql = "UPDATE enquiries SET 
            name = ?, 
            contact_no = ?, 
            type_of_job = ?, 
            date = ?, 
            time = ?, 
            package = ?, 
            email = ?, 
            location = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $name, $contact_no, $type_of_job, $date, $time, $package, $email, $location, $id);

    if ($stmt->execute()) {
        echo "Enquiry updated successfully!";
    } else {
        echo "Error updating enquiry: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
