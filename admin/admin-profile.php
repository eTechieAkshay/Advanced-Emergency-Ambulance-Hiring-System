<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['eahpaid'];
        $aname = $_POST['adminname'];
        $mobno = $_POST['mobilenumber'];
        $email = $_POST['email'];

        $query = mysqli_query($con, "update tbladmin set AdminName='$aname', MobileNumber='$mobno', Email='$email' where ID='$adminid'");
        if ($query) {
            echo "<script>alert('Admin profile has been updated.');</script>";
            echo "<script>window.location.href='admin-profile.php'</script>";
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
<title>EAHP | Admin Profile</title>
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
  .form-group-custom .form-control[readonly] { background: #f8fafc !important; color: #64748b !important; }
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
            <h3><i class="fa fa-user-md" style="color: #319795; margin-right: 8px;"></i> Profile Settings</h3>
            <?php
            $adminid = $_SESSION['eahpaid'];
            $ret = mysqli_query($con, "select * from tbladmin where ID='$adminid'");
            while ($row = mysqli_fetch_array($ret)) {
            ?>
            <form role="form" method="post">
                <div class="form-group-custom">
                    <label>Admin Name</label>
                    <input type="text" class="form-control" name="adminname" value="<?php echo $row['AdminName'];?>" required="true">
                </div>
                <div class="form-group-custom">
                    <label>User Name</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $row['UserName'];?>" readonly="true">
                </div>
                <div class="form-group-custom">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row['Email'];?>" required="true">
                </div>
                <div class="form-group-custom">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="mobilenumber" value="<?php echo $row['MobileNumber'];?>" maxlength="10" required="true">
                </div>
                <div class="form-group-custom">
                    <label>Registration Date</label>
                    <input type="text" class="form-control" value="<?php echo $row['AdminRegdate'];?>" readonly="true">
                </div>
                <button type="submit" name="submit" class="btn-submit-custom">Update Profile</button>
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