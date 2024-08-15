<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - View Submitted Enquiries</title>
    <link rel="stylesheet" href="css/view-enquiry.css">
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
                    <a href="html/gallery.html">Coastal Bird</a>
                </div>
            </li>
            <li><a href="html/login.html">Sign In</a></li>
        </ul>
    </nav>
</header>

<main class="dashboard">
    <aside class="sidebar">
        <ul>
            <li><a href="html/create-enquiry.html">Create a new Enquiry</a></li>
            <li><a href="view-enquiry.php">Submitted Enquiries</a></li>
            <li><a href="html/edit-enquiry.html">Edit existing Enquiries</a></li>
            <li><a href="html/add-testimonials.html">Submit a Testimonial</a></li>
            <li><a href="html/edit-user.html">Edit User Profile</a></li>
            <li><a href="html/view-map.html">View Google Maps</a></li>
        </ul>
    </aside>

    <section class="content">
        <h2>View Submitted Enquiries</h2>
        <table class="enquiries-table">
            <thead>
                <tr>
                    <th>Enquiry ID</th>
                    <th>Customer Name</th>
                    <th>Contact No</th>
                    <th>Type of Job</th>
                    <th>Package</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "photography_website";

                
                $conn = new mysqli($servername, $username, $password, $dbname);

            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                
                $sql = "SELECT * FROM enquiries";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td><a href='tel:" . $row["contact_no"] . "'>" . $row["contact_no"] . "</a></td>";
                        echo "<td>" . $row["type_of_job"] . "</td>";
                        echo "<td>" . $row["package"] . "</td>";
                        echo "<td><a href='mailto:" . $row["email"] . "'>" . $row["email"] . "</a></td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["time"] . "</td>";
                        echo "<td><a href='" . $row["location"] . "' target='_blank'>" . $row["location"] . "</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No enquiries found</td></tr>";
                }

              
                $conn->close();
                ?>
            </tbody>
        </table>
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
