<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit'])) {
    
    $bookingnum = mt_rand(100000000, 999999999);
    $pname = $_POST['pname'];
    $rname = $_POST['rname'];
    $phone = $_POST['phone']; // Will catch +91 format seamlessly
    $hdate = $_POST['hdate'];
    $htime = $_POST['htime'];
    $ambulancetype = $_POST['ambulancetype'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $message = $_POST['message'];
   
    // Linked string injection directly to RelativeConNum schema block
    $query = mysqli_query($con, "INSERT INTO tblambulancehiring (BookingNumber, PatientName, RelativeName, RelativeConNum, HiringDate, HiringTime, AmbulanceType, Address, City, State, Message) VALUES ('$bookingnum', '$pname', '$rname', '$phone', '$hdate', '$htime', '$ambulancetype', '$address', '$city', '$state', '$message')");

    if ($query) {
        echo "<script>alert('Your request has been sent successfully. Your Booking Number is: $bookingnum');</script>";
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Emergency Ambulance Hiring Portal || Home Page</title>
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    :root {
      --glass-bg: rgba(255, 255, 255, 0.07);
      --glass-border: rgba(255, 255, 255, 0.15);
      --glass-blur: blur(20px) saturate(190%);
      --glass-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
      --primary-accent: #ff2e63;
      --secondary-accent: #08d9d6;
      --text-light: #ffffff;
      --text-muted: #e0e0e0;
    }

    body {
      background: radial-gradient(circle at 20% 30%, #1a0f2b 0%, #0a0612 50%, #020105 100%) !important;
      color: var(--text-light);
      font-family: 'Poppins', sans-serif;
    }

    /* Fixed Top Spacing Header Layout */
    #header {
      background: rgba(13, 7, 26, 0.85) !important;
      backdrop-filter: blur(15px);
      border-bottom: 1px solid var(--glass-border);
    }

    /* Original Carousel Base Retained For Best Image View */
    #hero {
      width: 100%;
      height: 70vh !important;
      background: transparent !important;
      padding: 0 !important;
    }
    #hero .carousel-item {
      height: 70vh !important;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
    
    /* Realist Glass Card Wrapper For Text Box overlaying on images */
    #hero .carousel-item .container {
      background: rgba(13, 7, 26, 0.4) !important;
      backdrop-filter: blur(8px) saturate(140%);
      -webkit-backdrop-filter: blur(8px) saturate(140%);
      border: 1px solid rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 24px;
      max-width: 800px;
      margin-top: 10%;
      box-shadow: 0 15px 35px rgba(0,0,0,0.5);
    }

    #hero h2 {
      font-size: 2.8rem;
      font-weight: 700;
      color: #fff !important;
      text-shadow: 0 4px 12px rgba(0,0,0,0.8);
      margin-bottom: 25px;
    }
    #hero h2 span {
      color: var(--primary-accent) !important;
      text-shadow: 0 0 15px rgba(255, 46, 99, 0.6);
    }

    /* Rest of Glassmorphism Layout Modules */
    .icon-box, .form-control, .info-box {
      background: var(--glass-bg) !important;
      backdrop-filter: var(--glass-blur) !important;
      -webkit-backdrop-filter: var(--glass-blur) !important;
      border: 1px solid var(--glass-border) !important;
      border-radius: 24px !important;
      box-shadow: var(--glass-shadow) !important;
      color: var(--text-light) !important;
      transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }

    .icon-box:hover, .info-box:hover {
      transform: translateY(-8px) scale(1.02);
      border-color: rgba(8, 217, 214, 0.4) !important;
      box-shadow: 0 30px 60px rgba(8, 217, 214, 0.15), var(--glass-shadow) !important;
    }

    section {
      background: transparent !important;
      padding: 80px 0;
    }
    .section-title h2 {
      color: var(--text-light);
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
    }
    .section-title h2::after {
      background: var(--primary-accent) !important;
    }
    .section-title p {
      color: var(--text-muted);
    }

    .featured-services .icon-box .icon {
      background: rgba(255, 46, 99, 0.15) !important;
      width: 64px;
      height: 64px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px auto;
    }
    .featured-services .icon-box .icon i {
      color: var(--primary-accent) !important;
      font-size: 28px;
    }
    .featured-services .icon-box .title a {
      color: var(--text-light) !important;
      font-weight: 600;
    }

    .cta {
      background: linear-gradient(135deg, rgba(255, 46, 99, 0.15), rgba(8, 217, 214, 0.05)) !important;
      border: 1px solid rgba(255, 46, 99, 0.25) !important;
    }
    
    .btn-get-started, .cta-btn, .btn-primary {
      background: linear-gradient(90deg, var(--primary-accent), #ff5e7e) !important;
      border: none !important;
      color: var(--text-light) !important;
      padding: 14px 35px !important;
      border-radius: 50px !important;
      font-weight: 600 !important;
      letter-spacing: 1px;
      box-shadow: 0 0 20px rgba(255, 46, 99, 0.6) !important;
      display: inline-block;
      text-decoration: none;
    }
    .btn-get-started:hover, .cta-btn:hover, .btn-primary:hover {
      transform: scale(1.05);
      box-shadow: 0 0 30px rgba(255, 46, 99, 0.9) !important;
    }

    form.form-control {
      padding: 40px !important;
    }
    .form-group input, .form-group select, .form-group textarea {
      background: rgba(255, 255, 255, 0.05) !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      color: var(--text-light) !important;
      border-radius: 12px !important;
      padding: 12px 20px !important;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
      background: rgba(255, 255, 255, 0.08) !important;
      border-color: var(--secondary-accent) !important;
      box-shadow: 0 0 15px rgba(8, 217, 214, 0.4) !important;
    }
    select option {
      background: #120924 !important;
      color: var(--text-light);
    }

    .info-box i {
      font-size: 32px;
      color: var(--secondary-accent) !important;
      background: rgba(8, 217, 214, 0.1) !important;
      padding: 15px;
      border-radius: 50%;
    }
    .info-box h3 {
      color: var(--text-light) !important;
      font-size: 20px;
      font-weight: 600;
      margin: 15px 0 10px 0;
    }
  </style>
</head>

<body>

 <?php include_once('includes/header.php');?>

  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg)">
          <div class="container">
            <h2>Welcome to <span>Emergency Ambulance Hiring Portal</span></h2>
            <a href="#appointment" class="btn-get-started scrollto">Hire Ambulance</a>
          </div>
        </div>

        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg)">
          <div class="container">
            <h2>Welcome to <span>Emergency Ambulance Hiring Portal</span></h2>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
          <div class="container">
            <h2>Welcome to <span>Emergency Ambulance Hiring Portal</span></h2>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><main id="main">

    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row g-4">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="icon-box w-100 text-center" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-heartbeat"></i></div>
              <h4 class="title"><a href="">Life Support</a></h4>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="icon-box w-100 text-center" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-pills"></i></div>
              <h4 class="title"><a href="">Medical Support</a></h4>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="icon-box w-100 text-center" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-thermometer"></i></div>
              <h4 class="title"><a href="">Emergency Kit</a></h4>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="icon-box w-100 text-center" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="fas fa-baby"></i></div>
              <h4 class="title"><a href="">NICU Support</a></h4>
            </div>
          </div>

        </div>

      </div>
    </section><section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">
        <div class="text-center">
          <h3>In an emergency? Need help now?</h3>
          <a class="cta-btn scrollto" href="#appointment">Hire an Ambulance</a>
        </div>
      </div>
    </section><section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>About Us</h2>
          <?php
          $ret=mysqli_query($con,"select * from tblpage where PageType='aboutus' ");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
          <p><?php echo $row['PageDescription'];?></p>
          <?php } ?>
        </div>
      </div>
    </section><section id="appointment" class="appointment">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Hire an Ambulance</h2>
        </div>

        <form action="" method="post" role="form" class="form-control" data-aos="fade-up" data-aos-delay="100">
          <div class="row g-4">
            <div class="col-md-4 form-group">
              <input type="text" name="pname" class="form-control" id="pname" placeholder="Enter Patient Name" required>
            </div>
            <div class="col-md-4 form-group">
              <input type="text" name="rname" class="form-control" id="rname" placeholder="Enter Relative Name" required>
            </div>
            <div class="col-md-4 form-group">
              <input type="tel" class="form-control" name="phone" id="phone" value="+91 " placeholder="e.g. +91 8766xxxxxx" pattern="^\+91\s\d{10}$" title="Please follow standard country code format followed by 10 digit number: +91 9876543210" required>
            </div>
          </div>
          
          <div class="row g-4 mt-1">
            <div class="col-md-4 form-group">
              <input type="date" name="hdate" class="form-control" id="hdate" required>
            </div>
            <div class="col-md-4 form-group">
              <input type="time" name="htime" class="form-control" id="htime" required>
            </div>
            <div class="col-md-4 form-group">
              <select name="ambulancetype" id="ambulancetype" class="form-select">
                <option value="">Select Type of Ambulance</option>
                <option value="1">Basic Life Support (BLS) Ambulances</option>
                <option value="2">Advanced Life Support (ALS) Ambulances</option>
                <option value="3">Non-Emergency Patient Transport Ambulances</option>
                <option value="4">Boat Ambulance</option>
              </select>
            </div>
          </div>
          
          <div class="row g-4 mt-1">
            <div class="col-md-4 form-group">
              <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" required>
            </div>
            <div class="col-md-4 form-group">
              <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" required>
            </div>
            <div class="col-md-4 form-group">
              <input type="text" class="form-control" name="state" id="state" placeholder="Enter State" required>
            </div>
          </div>

          <div class="form-group mt-4">
            <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
          </div>
         
          <div class="text-center mt-4">
            <button type="submit" name="submit" class="btn btn-primary">Submit Request</button>
          </div>
        </form>

      </div>
    </section><section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Get in touch with our operators immediately. We operate 24 hours a day, 7 days a week.</p>
        </div>

        <div class="row g-4 mt-2">
          <div class="col-lg-12">
             <div class="row g-4">
              <?php 
              $query=mysqli_query($con,"select * from tblpage where PageType='contactus'");
              while ($row=mysqli_fetch_array($query)) {
              ?>
              <div class="col-md-12">
                <div class="info-box d-flex flex-column align-items-center justify-content-center p-4">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p class="m-0 text-center"><?php echo $row['PageDescription'];?></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box d-flex flex-column align-items-center justify-content-center p-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p class="m-0"><?php echo $row['Email'];?></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box d-flex flex-column align-items-center justify-content-center p-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p class="m-0"><?php echo $row['MobileNumber'];?></p>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>

      </div>
    </section></main><?php include_once('includes/footer.php');?>

  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script src="assets/js/main.js"></script>

</body>
</html>