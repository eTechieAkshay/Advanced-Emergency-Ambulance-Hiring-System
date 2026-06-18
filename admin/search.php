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
<title>EAHP | Search Requests</title>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="js/jquery2.0.3.min.js"></script>
<style>
  body { font-family: 'Poppins', sans-serif !important; background: #f4f7f6 !important; }
  .wrapper { background: #f4f7f6 !important; padding: 25px !important; }
  
  .search-card-custom {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
    padding: 25px !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02) !important;
    margin-bottom: 25px;
  }

  .search-card-custom h3 { font-size: 18px !important; font-weight: 600 !important; color: #1a202c !important; margin-top: 0; margin-bottom: 20px; }
  
  .search-input-group { display: flex !important; gap: 10px !important; max-width: 600px; }
  .search-input-group .form-control { height: 46px !important; border-radius: 8px !important; border: 1px solid #cbd5e1 !important; }
  .btn-search-trigger { background: #319795 !important; border: none !important; color: #fff !important; padding: 0 25px !important; border-radius: 8px !important; font-weight: 600 !important; }

  .table-custom th { background: #edf2f7 !important; color: #4a5568 !important; font-weight: 600 !important; padding: 14px 16px !important; font-size: 13px !important; border: none !important; text-transform: uppercase; }
  .table-custom td { padding: 14px 16px !important; font-size: 14px !important; color: #2d3748 !important; border-bottom: 1px solid #e2e8f0 !important; }
  .badge-custom { padding: 5px 12px !important; border-radius: 6px !important; font-size: 12px !important; display: inline-block; font-weight:500; }
  .status-new { background: #feebc8 !important; color: #c05621 !important; }
  .status-reached { background: #c6f6d5 !important; color: #22543d !important; }
  .view-action-link { background: #edf2f7 !important; color: #4a5568 !important; padding: 6px 14px !important; border-radius: 6px !important; text-decoration: none !important; font-size: 13px !important; }
</style>
</head>
<body>
<section id="container">
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>
<section id="main-content">
    <section class="wrapper">
        <div class="search-card-custom">
            <h3><i class="fa fa-search" style="color: #319795; margin-right: 8px;"></i> Search Ambulance Inquiry Logs</h3>
            <form method="post">
                <div class="search-input-group">
                    <input type="text" class="form-control" id="searchdata" name="searchdata" placeholder="Search by Booking Number, Patient Name or Mobile Number..." required="true">
                    <button type="submit" name="search" class="btn-search-trigger"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>

        <?php
        if (isset($_POST['search'])) {
            $sdata = $_POST['searchdata'];
        ?>
        <div class="search-card-custom" style="padding-top: 20px;">
            <h4 style="font-size:15px; font-weight:600; margin-bottom:15px; color:#4a5568;">Matches Found For: "<?php echo $sdata; ?>"</h4>
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
                        $ret = mysqli_query($con, "select * from tblambulancehiring where BookingNumber like '%$sdata%' or PatientName like '%$sdata%' or RelativeConNo like '%$sdata%'");
                        $num = mysqli_num_rows($ret);
                        if ($num > 0) {
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
                                echo $row['Status'] ? '<span class="badge-custom status-reached">'.$row['Status'].'</span>' : '<span class="badge-custom status-new">New Request</span>';
                                ?>
                            </td>
                            <td><a href="view-ambulance-request.php?id=<?php echo $row['ID']; ?>&bookingnum=<?php echo $row['BookingNumber']; ?>" class="view-action-link">Review</a></td>
                        </tr>
                        <?php 
                            $cnt++;
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="7" style="text-align: center; color: #e53e3e; padding: 20px !important;">No records found matching your query criteria.</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>
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