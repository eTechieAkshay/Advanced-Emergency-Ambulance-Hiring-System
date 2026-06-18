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
<title>EAHP | All Ambulance Requests</title>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="js/jquery2.0.3.min.js"></script>
<style>
  body { font-family: 'Poppins', sans-serif !important; background: #f4f7f6 !important; }
  .wrapper { background: #f4f7f6 !important; padding: 25px !important; }
  
  .table-card-custom {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
    padding: 25px !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02) !important;
  }

  .table-card-custom h3 {
    font-size: 20px !important;
    font-weight: 600 !important;
    color: #1a202c !important;
    margin-top: 0 !important;
    margin-bottom: 20px !important;
  }

  .table-custom th {
    background: #edf2f7 !important;
    color: #4a5568 !important;
    font-weight: 600 !important;
    padding: 14px 16px !important;
    font-size: 13px !important;
    border: none !important;
    text-transform: uppercase;
  }

  .table-custom td {
    padding: 14px 16px !important;
    font-size: 14px !important;
    color: #2d3748 !important;
    border-bottom: 1px solid #e2e8f0 !important;
  }

  /* Status Tags Theme */
  .badge-custom {
    padding: 5px 12px !important;
    border-radius: 6px !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    display: inline-block;
  }
  .status-new { background: #feebc8 !important; color: #c05621 !important; }
  .status-assigned { background: #e2e8f0 !important; color: #4a5568 !important; }
  .status-way { background: #ebf8ff !important; color: #2b6cb0 !important; }
  .status-pickup { background: #e6fffa !important; color: #234e52 !important; }
  .status-reached { background: #c6f6d5 !important; color: #22543d !important; }
  .status-rejected { background: #fed7d7 !important; color: #9b2c2c !important; }

  .view-action-link {
    background: #edf2f7 !important;
    color: #4a5568 !important;
    padding: 6px 14px !important;
    border-radius: 6px !important;
    text-decoration: none !important;
    font-size: 13px !important;
    font-weight: 500;
  }
  .view-action-link:hover {
    background: #319795 !important;
    color: #ffffff !important;
  }
</style>
</head>
<body>
<section id="container">
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>
<section id="main-content">
    <section class="wrapper">
        <div class="table-card-custom">
            <h3><i class="fa fa-file-text-o" style="color: #319795; margin-right: 8px;"></i> All Ambulance Requests</h3>
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Booking No.</th>
                            <th>Patient Name</th>
                            <th>Relative Contact</th>
                            <th>Hiring Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "select * from tblambulancehiring");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><strong><?php echo $row['BookingNumber']; ?></strong></td>
                            <td><?php echo $row['PatientName']; ?></td>
                            <td><?php echo $row['RelativeConNo']; ?></td>
                            <td><?php echo $row['HiringDate']; ?></td>
                            <td>
                                <?php 
                                $status = $row['Status'];
                                if($status == "") {
                                    echo '<span class="badge-custom status-new">New Request</span>';
                                } else if($status == "Assigned") {
                                    echo '<span class="badge-custom status-assigned">Assigned</span>';
                                } else if($status == "On the way") {
                                    echo '<span class="badge-custom status-way">On The Way</span>';
                                } else if($status == "Pickup") {
                                    echo '<span class="badge-custom status-pickup">Picked Up</span>';
                                } else if($status == "Reached") {
                                    echo '<span class="badge-custom status-reached">Reached</span>';
                                } else {
                                    echo '<span class="badge-custom status-rejected">Rejected</span>';
                                }
                                ?>
                            </td>
                            <td><a href="view-ambulance-request.php?id=<?php echo $row['ID']; ?>&bookingnum=<?php echo $row['BookingNumber']; ?>" class="view-action-link">Review</a></td>
                        </tr>
                        <?php $cnt = $cnt + 1; } ?>
                    </tbody>
                </table>
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