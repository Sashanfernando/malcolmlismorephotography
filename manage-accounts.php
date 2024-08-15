<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Accounts</title>
    <link rel="stylesheet" href="css/manage-accounts.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
<header>
    <div class="logo">
        <img src="../logo1.jpeg" alt="Logo">
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
                    <a href="html/gallery.html">Coastal Birds</a>
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
        <h2>Manage User Accounts</h2>
        <div class="account-table">
            <table>
                <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Full Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Profile Picture</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
              
                $host = 'localhost';
                $db = 'photography_website';
                $user = 'root';
                $pass = '';

                $conn = new mysqli($host, $user, $pass, $db);

              
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }

               
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['contact']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['username']}</td>";
                        if (!empty($row['profile_picture']) && file_exists('../uploads/' . $row['profile_picture'])) {
                            echo "<td><img src='../uploads/{$row['profile_picture']}' alt='Profile Picture' width='50' height='50'></td>";
                        } else {
                            echo "<td>No picture</td>";
                        }

                        echo "<td>
                            <form action='delete-user.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='user_id' value='{$row['id']}'>
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
            </table>
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
</body>
</html>
