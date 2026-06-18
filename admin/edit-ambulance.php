<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $eid = $_GET['editid'];
        $ambno = $_POST['ambno'];
        $ambtype = $_POST['ambtype'];
        $drivername = $_POST['drivername'];
        $drivernum = $_POST['drivernum'];

        $query = mysqli_query($con, "update tblambulance set AmbulanceNumber='$ambno', AmbulanceType='$ambtype', DriverName='$drivername', DriverMobileNumber='$drivernum' where ID='$eid'");
        if ($query) {
            echo "<script>alert('Ambulance details updated successfully.');</script>";
            echo "<script>window.location.href='manage-ambulance.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EAHP | Edit Ambulance</title>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="js/jquery2.0.3.min.js"></script>
<style>
  body { font-family: 'Poppins', sans-serif !important; background: #f4f7f6 !important; }
  .wrapper { background: #f4f7f6 !important; padding: 30px !important; }
  .form-card-custom { background: #fff !important; border: 1px solid #e2e8f0 !important; border-radius: 16px !important; padding: 35px !important; max-width: 700px; margin: 0 auto !important; box-shadow: 0 4px 20px rgba(0,0,0,0.02) !important; }
  .form-card-custom h3 { font-size: 20px !important; font-weight: 600 !important; color: #1a202c !important; margin-top: 0; margin-bottom: 25px; border-bottom: 2px solid #edf2f7; padding-bottom: 12px; }
  .form-group-custom { margin-bottom: 22px !important; }
  .form-group-custom label { font-weight: 500 !important; color: #4a5568 !important; font-size: 14px !important; margin-bottom: 8px !important; display: block; }
  .form-group-custom .form-control { height: 46px !important; border: 1px solid #cbd5e1 !important; border-radius: 8px !important; font-size: 14px !important; color: #334155 !important; }
  .btn-submit-custom { background: #319795 !important; border: none !important; color: #fff !important; padding: 12px 30px !important; font-size: 15px !important; font-weight: 600 !important; border-radius: 8px !important; cursor: pointer !important; box-shadow: 0 4px 12px rgba(49, 151, 149, 0.2) !important; }
</style>
</head>
<body>
<section id="container">
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>
<section id="main-content">
    <section class="wrapper">
        <div class="form-card-custom">
            <h3><i class="fa fa-edit" style="color: #319795; margin-right: 8px;"></i> Update Ambulance Details</h3>
            <?php
            $eid = $_GET['editid'];
            $ret = mysqli_query($con, "select * from tblambulance where ID='$eid'");
            while ($row = mysqli_fetch_array($ret)) {
            ?>
            <form role="form" method="post">
                <div class="form-group-custom">
                    <label>Ambulance Number</label>
                    <input type="text" class="form-control" name="ambno" value="<?php echo $row['AmbulanceNumber'];?>" required="true">
                </div>
                <div class="form-group-custom">
                    <label>Ambulance Type</label>
                    <select class="form-control" name="ambtype" required="true">
                        <option value="<?php echo $row['AmbulanceType'];?>"><?php echo $row['AmbulanceType'];?></option>
                        <option value="Basic Life Support (BLS)">Basic Life Support (BLS)</option>
                        <option value="Advanced Life Support (ALS)">Advanced Life Support (ALS)</option>
                        <option value="Patient Transport Vehicle (PTV)">Patient Transport Vehicle (PTV)</option>
                        <option value="ICU Ambulance">ICU Ambulance</option>
                    </select>
                </div>
                <div class="form-group-custom">
                    <label>Driver Name</label>
                    <input type="text" class="form-control" name="drivername" value="<?php echo $row['DriverName'];?>" required="true">
                </div>
                <div class="form-group-custom">
                    <label>Driver Mobile Number</label>
                    <input type="text" class="form-control" name="drivernum" value="<?php echo $row['DriverMobileNumber'];?>" maxlength="10" pattern="[0-9]{10}" required="true">
                </div>
                <button type="submit" name="submit" class="btn-submit-custom">Save Updates</button>
            </form>
            <?php } ?>
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