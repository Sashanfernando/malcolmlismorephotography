<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Images - Malcolm Lismore Photography</title>
    <link rel="stylesheet" href="css/delete-image.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<header>
    <div class="logo">
        <img src="../logo1.jpeg" alt="Malcolm Lismore Photography">
    </div>
    <nav>
        <ul>
            <li><a href="html/index.html">Home</a></li>
            <li class="dropdown">
                <a href="html/services.html" class="dropbtn">Services</a>
                <div class="dropdown-content">
                    <a href="html/services.html">Weddings</a>
                    <a href="html/services.html">Portraits</a>
                    <a href="html/services.html">Special Events</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="html/gallery.html" class="dropbtn">Gallery</a>
                <div class="dropdown-content">
                    <a href="html/gallery.html">Landscape</a>
                    <a href="html/gallery.html">Wildlife</a>
                    <a href="html/gallery.html">Coastal Bird</a>
                </div>
            </li>
            <li><a href="html/login.html">Sign In</a></li>
        </ul>
    </nav>
</header>

<main class="admin-dashboard">
<aside class="sidebar">
        <ul>
            <li><a href="html/admin-dashboard.html">Upload New Images</a></li>
            <li><a href="delete-image.php">Delete Images</a></li>
            <li><a href="manage-enquiries.php">Manage Enquiries</a></li>
            <li><a href="html/edit-profile.html">Edit Profile</a></li>
            <li><a href="manage-accounts.php">Manage Accounts</a></li>
            <li><a href="manage-testimonials.php">Manage Testimonials</a></li>
           
        </ul>
    </aside>

    <section class="content">
        <h2>Remove Images from Gallery</h2>
        <div class="delete-images-container">
            <form class="delete-form" action="delete-image.php" method="POST">
                <select >
                    <?php
                    $conn = new mysqli("localhost", "root", "", "photography_website");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $result = $conn->query("SELECT filename FROM gallery_images");
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['filename']."'>".$row['filename']."</option>";
                    }
                    $conn->close();
                    ?>
                </select>
                <button type="submit" name="delete">Delete</button>
            </form>
        </div>
    </section>
</main>

<footer>
    <ul>
        <li><a href="html/index.html">Home</a></li>
        <li><a href="html/services.html">Services</a></li>
        <li><a href="html/gallery.html">Gallery</a></li>
        <li><a href="html/about.html">About</a></li>
        <li><a href="html/contact.html">Contact</a></li>
    </ul>
    <div class="social-icons">
        <a href="https://www.facebook.com/yourpage" target="_blank"><i class="ri-facebook-fill"></i></a>
        <a href="https://www.messenger.com/yourpage" target="_blank"><i class="ri-messenger-fill"></i></a>
        <a href="https://www.instagram.com/yourpage" target="_blank"><i class="ri-instagram-fill"></i></a>
        <a href="https://www.linkedin.com/yourpage" target="_blank"><i class="ri-linkedin-fill"></i></a>
    </div>
</footer>

<?php
if (isset($_POST['delete'])) {
    $filenameToDelete = $_POST['imageToDelete'];
    $conn = new mysqli("localhost", "root", "", "photography_website");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $filePath = __DIR__ . "/../uploads/" . $filenameToDelete;

    
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    
    $delete = $conn->query("DELETE FROM gallery_images WHERE filename='".$filenameToDelete."'");
    if ($delete) {
        echo "The file has been deleted successfully.";
    } else {
        echo "Failed to delete the file.";
    }
    $conn->close();

    
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
</body>
</html>
