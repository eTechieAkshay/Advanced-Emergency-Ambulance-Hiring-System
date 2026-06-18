<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $bid = $_GET['id'];
        $resstatus = $_POST['status'];
        $remark = $_POST['remark'];
        $assignee = $_POST['assignee'];

        $query = mysqli_query($con, "update tblambulancehiring set Status='$resstatus', Remark='$remark', AmbulanceAssigned='$assignee' where ID='$bid'");
        if ($query) {
            echo "<script>alert('Request updated successfully.');</script>";
            echo "<script>window.location.href='all-amublance-request.php'</script>";
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
<title>EAHP | View Ambulance Request</title>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="js/jquery2.0.3.min.js"></script>
<style>
  body { font-family: 'Poppins', sans-serif !important; background: #f4f7f6 !important; }
  .wrapper { background: #f4f7f6 !important; padding: 25px !important; }
  
  .details-card-custom {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
    padding: 30px !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02) !important;
    margin-bottom: 25px;
  }

  .details-card-custom h3 {
    font-size: 18px !important;
    font-weight: 600 !important;
    color: #1a202c !important;
    margin-top: 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #edf2f7;
    padding-bottom: 10px;
  }

  .info-table td {
    padding: 12px 15px !important;
    font-size: 14px !important;
  }
  
  .info-table td.label-cell {
    font-weight: 600 !important;
    color: #4a5568 !important;
    width: 30%;
    background: #f8fafc;
  }

  .update-form-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
  }
</style>
</head>
<body>
<section id="container">
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>
<section id="main-content">
    <section class="wrapper">
        <div class="details-card-custom">
            <h3><i class="fa fa-user" style="color: #319795; margin-right: 8px;"></i> Request Details (Booking No: <?php echo $_GET['bookingnum']; ?>)</h3>
            
            <?php
            $bid = $_GET['id'];
            $ret = mysqli_query($con, "select * from tblambulancehiring where ID='$bid'");
            while ($row = mysqli_fetch_array($ret)) {
            ?>
            <div class="table-responsive">
                <table class="table table-bordered info-table">
                    <tr>
                        <td class="label-cell">Patient Name</td>
                        <td><?php echo $row['PatientName']; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Relative Name</td>
                        <td><?php echo $row['RelativeName']; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Relative Mobile</td>
                        <td><?php echo $row['RelativeConNo']; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Hiring Date/Time</td>
                        <td><?php echo $row['HiringDate']; ?> / <?php echo $row['HiringTime']; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Pickup Address</td>
                        <td><?php echo $row['PickupAddress']; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Destination Address</td>
                        <td><?php echo $row['DestinationAddress']; ?></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Current Status</td>
                        <td><strong><?php echo $row['Status'] ? $row['Status'] : 'New Request'; ?></strong></td>
                    </tr>
                </table>
            </div>

            <?php if($row['Status'] != 'Reached' && $row['Status'] != 'Rejected') { ?>
            <div class="update-form-box">
                <h4 style="font-weight:600; margin-bottom:15px; font-size:15px; color:#2d3748;">Update Request Status</h4>
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <label style="font-size:13px; font-weight:500;">Select Status</label>
                            <select name="status" class="form-control" required="true" style="height:42px; border-radius:6px;">
                                <option value="">Select</option>
                                <option value="Assigned">Assigned</option>
                                <option value="On the way">On the way</option>
                                <option value="Pickup">Patient Picked</option>
                                <option value="Reached">Patient Reached</option>
                                <option value="Rejected">Reject Request</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:13px; font-weight:500;">Assign Ambulance</label>
                            <select name="assignee" class="form-control" style="height:42px; border-radius:6px;">
                                <option value="">Select Ambulance</option>
                                <?php 
                                $amb_q = mysqli_query($con, "select * from tblambulance");
                                while($amb_r = mysqli_fetch_array($amb_q)) {
                                    echo "<option value='".$amb_r['AmbulanceNumber']."'>".$amb_r['AmbulanceNumber']." (".$amb_r['DriverName'].")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:13px; font-weight:500;">Remark / Notes</label>
                            <input type="text" name="remark" class="form-control" required="true" placeholder="Enter comments" style="height:42px; border-radius:6px;">
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn" style="background:#319795; color:#fff; margin-top:15px; font-weight:600; padding:10px 25px; border-radius:6px; border:none;">Update Order</button>
                </form>
            </div>
            <?php } ?>

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