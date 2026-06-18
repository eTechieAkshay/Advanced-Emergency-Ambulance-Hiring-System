<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['eahpaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $query = mysqli_query($con, "delete from tblambulance where ID='$rid'");
        echo "<script>alert('Data deleted successfully.');</script>";
        echo "<script>window.location.href='manage-ambulance.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EAHP | Manage Ambulance</title>
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

  .table-responsive-custom {
    border: none !important;
    margin-top: 15px;
  }

  .table-custom {
    width: 100% !important;
    border-collapse: collapse !important;
  }

  .table-custom th {
    background: #edf2f7 !important;
    color: #4a5568 !important;
    font-weight: 600 !important;
    padding: 14px 16px !important;
    font-size: 14px !important;
    border: none !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .table-custom td {
    padding: 14px 16px !important;
    font-size: 14px !important;
    color: #2d3748 !important;
    border-bottom: 1px solid #e2e8f0 !important;
  }

  .table-custom tr:hover td {
    background: #f8fafc !important;
  }

  .action-btn-edit {
    color: #319795 !important;
    font-weight: 500;
    margin-right: 12px;
  }

  .action-btn-delete {
    color: #e53e3e !important;
    font-weight: 500;
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
            <h3><i class="fa fa-list" style="color: #319795; margin-right: 8px;"></i> Manage Vehicles</h3>
            <div class="table-responsive-custom">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Ambulance No.</th>
                            <th>Type</th>
                            <th>Driver Name</th>
                            <th>Driver Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "select * from tblambulance");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><strong><?php echo $row['AmbulanceNumber']; ?></strong></td>
                            <td><?php echo $row['AmbulanceType']; ?></td>
                            <td><?php echo $row['DriverName']; ?></td>
                            <td><?php echo $row['DriverMobileNumber']; ?></td>
                            <td>
                                <a href="edit-ambulance.php?editid=<?php echo $row['ID']; ?>" class="action-btn-edit"><i class="fa fa-edit"></i> Edit</a>
                                <a href="manage-ambulance.php?delid=<?php echo $row['ID']; ?>" class="action-btn-delete" onclick="return confirm('Do you really want to delete this record?');"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
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