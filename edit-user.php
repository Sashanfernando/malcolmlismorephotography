<?php

$message = '';
$messageClass = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $host = 'localhost';
    $db = 'photography_website';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

  
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $birthday = $conn->real_escape_string($_POST['birthday']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

   
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = $_FILES['profile_picture'];
        $profile_picture_name = $profile_picture['name'];
        $profile_picture_tmp_name = $profile_picture['tmp_name'];
        $profile_picture_size = $profile_picture['size'];
        $profile_picture_error = $profile_picture['error'];
        $profile_picture_type = $profile_picture['type'];

        $profile_picture_ext = explode('.', $profile_picture_name);
        $profile_picture_actual_ext = strtolower(end($profile_picture_ext));
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($profile_picture_actual_ext, $allowed)) {
            if ($profile_picture_error === 0) {
                if ($profile_picture_size < 1000000) { 
                    $profile_picture_new_name = uniqid('', true) . "." . $profile_picture_actual_ext;
                    $profile_picture_destination = 'uploads/' . $profile_picture_new_name;
                    move_uploaded_file($profile_picture_tmp_name, $profile_picture_destination);
                } else {
                    $message = 'Your profile picture is too large.';
                    $messageClass = 'error-message';
                }
            } else {
                $message = 'There was an error uploading your profile picture.';
                $messageClass = 'error-message';
            }
        } else {
            $message = 'Invalid file type. Please upload a JPG, JPEG, PNG, or GIF file.';
            $messageClass = 'error-message';
        }
    } else {
        $profile_picture_new_name = ''; 
    }

   
    $sql = "UPDATE users SET name='$name', address='$address', gender='$gender', birthday='$birthday', contact='$contact', email='$email', profile_picture='$profile_picture_new_name', username='$username', password='$password' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $message = 'Profile updated successfully!';
        $messageClass = 'success-message';
    } else {
        $message = 'Profile update failed. Please try again.';
        $messageClass = 'error-message';
    }

  
    $conn->close();
}
?>
