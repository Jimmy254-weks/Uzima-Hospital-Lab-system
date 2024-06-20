<?php
error_reporting(E_ALL);
include_once('includes/db_connect.php');

// Handle form submission
if(isset($_POST['submit'])) {

    // Check if database connection was successful
    if($conn) {
        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $mobileno = $_POST['mobileno'];
        $description = $_POST['message'];
        
        // Insert data into tblcontactus table
        $query = "INSERT INTO tblcontactus (fullname, email, contactno, message) VALUES ('$name', '$email', '$mobileno', '$description')";
        if(mysqli_query($conn, $query)) {
            // Show success message and redirect to homepage
            echo "<script>alert('Your information has been successfully submitted');</script>";
            echo "<script>window.location.href ='index.php'</script>";
        } else {
            // Show error message if insertion fails
            //. The dot operator is used for concatenation in PHP. It joins/combines two or more strings into a single string.
            echo "insertion failed " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        // Show error message if database connection failed
        echo "Database connection failed. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uzima Hospital Lab System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Main Header starts -->
    <header id="main-header">
        <div class="container">
            <div class="name">UHL</div>
            <div id="menu" class="nav-item">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about_us">About Us</a></li>
                    <li><a href="#contact_us">Contact Us</a></li>
                    <li><a href="#logins">Logins</a></li>
                </ul>
            </div>
            <div class="col-book_appoint">
                <a class="btn-success" href="patient/patient_login.php">Book an Appointment</a>
            </div>
        </div>
    </header>
    <!-- Main Header Ends -->

    <div class="slider"><br><br>
        <div class="slider-container" style="background-image: url('img/slider_2.jpg');">
            <p>UZIMA HOSPITAL LABORATORY</p>
        </div>
    </div> <br> <br><br><br>

    <div class="home-body">
    <!-- First Div -->
    <div class="first-div">
        <p style="text-transform: uppercase;">Welcome to Uzima Lab Hospital</p>
        <p style="font-style: italic; text-transform: lowercase;">Your BloodLife Testing Partner</p>
    </div>
</div>


    <!-- Logins Section -->
    <section id="logins">
        <h2>Logins</h2><br>
        <div class="container">
            <div class="inner-title">

            </div>
            <div class="row no-margin">
                <div class="col-sm-4 blog-smk">
                    <div class="blog-single">
                        <img src="img/patient.jpeg" alt="Patient">
                        <div class="blog-single-det">
                            <h6>Patient Login</h6>
                            <a href="patient/patient_login.php">
                                <button class="btn success">Login</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 blog-smk">
                    <div class="blog-single">
                        <img src="img/doctor.jpeg" alt="Doctor">
                        <div class="blog-single-det">
                            <h6>Doctor Login</h6>
                            <a href="doctors/index.php">
                                <button class="btn success">Login</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 blog-smk">
                    <div class="blog-single">
                        <img src="img/admin.jpeg" alt="Admin ">
                        <div class="blog-single-det">
                            <h6>Admin Login</h6>
                            <a href="admin/index.php">
                                <button class="btn success">Login</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!-- Key Features Section -->
     <section id="services" class="our-key-features">
        <div class="container">
            <h2>Some of Our Services</h2><br>
            <div class="service-row">
                <div class="service">
                    <img src="img/Phlebotomy.jpeg" alt="Phlebotomy">
                    <h5>Phlebotomy</h5>
                </div>
                <div class="service">
                    <img src="img/hematology.jpeg" alt="Hematology">
                    <h5>Hematology</h5>
                </div>
                <div class="service">
                    <img src="img/transfusion.png" alt="Blood Bank & Transfusion">
                    <h5>Blood Bank & Transfusion</h5>
                </div>
                <div class="service">
                    <img src="img/clinical_chemistry.jpeg" alt="Clinical Chemistry">
                    <h5>Clinical Chemistry</h5>
                </div>
                <div class="service">
                    <img src="img/immunology.jpeg" alt="Immunology">
                    <h5>Immunology</h5>
                </div>
                <div class="service">
                    <img src="img/microbiology.jpeg" alt="Microbiology">
                    <h5>Microbiology</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about_us" class="about-us">
        <div class="container">
            <div class="about-content">
                <div class="image-about">
                    <img src="img/about_bg.webp" alt="About Us Image">
                </div>
                <div class="text-about">
                    <h3>About Uzima Hospital Lab</h3>
                    <p>
                        Uzima Hospital Lab is a leading healthcare facility dedicated to providing high-quality medical services to the community. With a focus on patient care and innovation, Uzima Hospital Lab strives to be a center of excellence in healthcare delivery. Our hospital lab is equipped with state-of-the-art technology and staffed by a team of highly skilled professionals, including doctors, nurses, and technicians. We offer a wide range of medical services, including phlebotomy, hematology, blood bank and transfusion, clinical chemistry, immunology, and microbiology.<br><br> At Uzima Hospital Lab, we prioritize patient satisfaction and safety above all else. <br>We are committed to delivering personalized care tailored to each patient's unique needs. Our compassionate staff works tirelessly to ensure that every patient receives the attention and support they deserve. In addition to our medical services, we are also dedicated to promoting health and wellness within the community. Through outreach programs and health education initiatives, we strive to empower individuals to take control of their health and live healthier lives.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section id="contact_us" class="contact_us">
        <footer class="site-footer">
            <div class="footer-container">
                <div class="footer-section">
                    <section id="contact-us">
                        <h3>Contact Us</h3>
                        <p>Email: jamesweks2019@gmail.com</p><br>
                        <p>Telephone: +254723007834</p><br>
                        <p>Address: Moi Avenue, Nairobi</p><br>

                    </section>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about_us">About Us</a></li>
                        <li><a href="#contact_us">Contact Us</a></li>
                        <li><a href="#logins">Logins</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Form</h3>
                    <form method="post">
                        <div class="row cf-ro">
                            <div class="col-sm-3"><label>Enter Name :</label></div>
                            <input type="text" placeholder="Your Name" name="fullname" class="form-control input-sm" required>

                        </div>
                        <div class="row cf-ro">
                            <div class="col-sm-3"><label>Email Address :</label></div>
                            <div class="col-sm-8"><input type="email" name="email" placeholder="Your Email Address" class="form-control input-sm" required></div>
                        </div>
                        <div class="row cf-ro">
                            <div class="col-sm-3"><label>Mobile Number :</label></div>
                            <div class="col-sm-8"><input type="text" name="mobileno" placeholder="Your Mobile Number" class="form-control input-sm" required></div>
                        </div>
                        <div class="row cf-ro">
                            <div class="col-sm-3"><label>Enter Message :</label></div>
                            <div class="col-sm-8">
                                <textarea rows="5" placeholder="Your Message" class="form-control input-sm" name="message" required></textarea>
                            </div>
                        </div>
                        <div class="row cf-ro">
                            <div class="col-sm-3"><label></label></div><br>
                            <div class="col-sm-8">
                                <button class="btn btn-success btn-sm" type="submit" name="submit">Post message</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="footer-social">
                <h3>Follow Us</h3><br>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
            </div>
            <div class="footer-bottom">
                <p>Copyright &copy; <?php echo date("Y"); ?> UHL | Designed by James Wekesa</p>
            </div>
        </footer>
    </section>
</body>
</html>
    

