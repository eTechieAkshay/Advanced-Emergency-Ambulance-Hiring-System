<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EAHP | Dashboard</title>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="js/jquery2.0.3.min.js"></script>
<style>
  body { font-family: 'Poppins', sans-serif !important; background: #f4f7f6 !important; }
  .wrapper { background: #f4f7f6 !important; padding: 30px !important; }
  
  .dashboard-header-title {
    font-size: 22px !important;
    font-weight: 600 !important;
    color: #1a202c !important;
    margin-bottom: 25px !important;
  }

  .stat-grid-container {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)) !important;
    gap: 20px !important;
    margin-bottom: 30px !important;
  }

  .stat-card-premium {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 16px !important;
    padding: 24px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01) !important;
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .stat-card-premium:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04) !important;
  }

  .stat-info-box h4 {
    font-size: 13px !important;
    font-weight: 500 !important;
    color: #718096 !important;
    text-transform: uppercase !important;
    margin: 0 0 6px 0 !important;
    letter-spacing: 0.5px;
  }

  .stat-info-box .stat-counter {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: #1a202c !important;
    margin: 0 !important;
  }

  .stat-icon-wrapper {
    width: 52px !important;
    height: 52px !important;
    border-radius: 12px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 22px !important;
  }

  /* Theme Accents */
  .accent-blue { background: #e0f2fe !important; color: #0369a1 !important; }
  .accent-amber { background: #fef3c7 !important; color: #b45309 !important; }
  .accent-emerald { background: #d1fae5 !important; color: #047857 !important; }
  .accent-rose { background: #ffe4e6 !important; color: #be123c !important; }
</style>
</head>
<body>
<section id="container">
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>
<section id="main-content">
    <section class="wrapper">
        <h2 class="dashboard-header-title">Overview Dashboard</h2>
        
        <div class="stat-grid-container">
            <!-- Total Ambulances -->
            <?php 
            $q_amb = mysqli_query($con, "SELECT ID FROM tblambulance");
            $total_amb = mysqli_num_rows($q_amb);
            ?>
            <div class="stat-card-premium">
                <div class="stat-info-box">
                    <h4>Total Ambulances</h4>
                    <p class="stat-counter"><?php echo $total_amb; ?></p>
                </div>
                <div class="stat-icon-wrapper accent-blue">
                    <i class="fa fa-ambulance"></i>
                </div>
            </div>

            <!-- New Requests -->
            <?php 
            $q_new = mysqli_query($con, "SELECT ID FROM tblambulancehiring WHERE Status='' OR Status IS NULL");
            $total_new = mysqli_num_rows($q_new);
            ?>
            <div class="stat-card-premium">
                <div class="stat-info-box">
                    <h4>New Requests</h4>
                    <p class="stat-counter"><?php echo $total_new; ?></p>
                </div>
                <div class="stat-icon-wrapper accent-amber">
                    <i class="fa fa-bell-o"></i>
                </div>
            </div>

            <!-- Reached/Completed -->
            <?php 
            $q_comp = mysqli_query($con, "SELECT ID FROM tblambulancehiring WHERE Status='Reached'");
            $total_comp = mysqli_num_rows($q_comp);
            ?>
            <div class="stat-card-premium">
                <div class="stat-info-box">
                    <h4>Successful Trips</h4>
                    <p class="stat-counter"><?php echo $total_comp; ?></p>
                </div>
                <div class="stat-icon-wrapper accent-emerald">
                    <i class="fa fa-check-circle-o"></i>
                </div>
            </div>

            <!-- Rejected Requests -->
            <?php 
            $q_rej = mysqli_query($con, "SELECT ID FROM tblambulancehiring WHERE Status='Rejected'");
            $total_rej = mysqli_num_rows($q_rej);
            ?>
            <div class="stat-card-premium">
                <div class="stat-info-box">
                    <h4>Rejected Cases</h4>
                    <p class="stat-counter"><?php echo $total_rej; ?></p>
                </div>
                <div class="stat-icon-wrapper accent-rose">
                    <i class="fa fa-times-circle-o"></i>
                </div>
            </div>
        </div>
    </section>
    <?php include_once('includes/footer.php');?>
</section>
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<?php } ?>