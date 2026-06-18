<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contactno = mysqli_real_escape_string($con, $_POST['contactno']);

    $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE Email='$email' AND MobileNumber='$contactno'");
    $ret = mysqli_fetch_array($query);
    if($ret > 0){
        $_SESSION['contactno'] = $contactno;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
        exit();
    }
    else{
        echo "<script>alert('Invalid Details. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EAHP | Forgot Password</title>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<style>
  html, body { 
    height: 100% !important; 
    margin: 0 !important; 
    padding: 0 !important; 
    font-family: 'Poppins', sans-serif !important; 
    background: #0f172a !important;
  }
  
  .auth-fullscreen-wrapper {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background: radial-gradient(circle at 20% 30%, #1e293b 0%, #0f172a 100%) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 20px !important;
    box-sizing: border-box !important;
  }

  .auth-custom-card {
    position: relative !important;
    width: 100% !important;
    max-width: 420px !important;
    background: rgba(30, 41, 59, 0.7) !important;
    backdrop-filter: blur(16px) !important;
    -webkit-backdrop-filter: blur(16px) !important;
    border: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-radius: 24px !important;
    padding: 45px 35px !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
    box-sizing: border-box !important;
    text-align: center;
  }

  .auth-custom-card h2 {
    font-size: 26px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    margin: 0 0 8px 0 !important;
    letter-spacing: -0.5px;
  }

  .auth-custom-card p.subtitle {
    color: #94a3b8 !important;
    font-size: 14px !important;
    margin: 0 0 35px 0 !important;
    font-weight: 400 !important;
  }

  .input-group-custom {
    position: relative !important;
    margin-bottom: 22px !important;
    width: 100% !important;
  }

  .input-group-custom i {
    position: absolute !important;
    left: 16px !important;
    top: 15px !important;
    color: #38bdf8 !important;
    font-size: 16px !important;
  }

  .input-group-custom input {
    width: 100% !important;
    padding: 14px 15px 14px 45px !important;
    background: rgba(15, 23, 42, 0.6) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: #ffffff !important;
    border-radius: 12px !important;
    font-size: 15px !important;
    outline: none !important;
    box-sizing: border-box !important;
    display: block !important;
    transition: all 0.3s ease !important;
  }

  .input-group-custom input:focus {
    border-color: #38bdf8 !important;
    background: rgba(15, 23, 42, 0.8) !important;
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2) !important;
  }

  .auth-custom-card button[type="submit"] {
    width: 100% !important;
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%) !important;
    border: none !important;
    color: #ffffff !important;
    padding: 14px !important;
    border-radius: 12px !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    cursor: pointer !important;
    box-shadow: 0 10px 25px -5px rgba(14, 165, 233, 0.4) !important;
    transition: all 0.2s !important;
    margin-top: 10px;
  }

  .auth-custom-card button[type="submit"]:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 30px -5px rgba(14, 165, 233, 0.5) !important;
  }

  .auth-nav-flex-links {
    margin-top: 30px !important;
    padding-top: 20px !important;
    border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
    display: flex !important;
    justify-content: space-between !important;
  }

  .auth-nav-flex-links a {
    color: #38bdf8 !important;
    font-size: 14px !important;
    text-decoration: none !important;
    font-weight: 500 !important;
  }
  
  .auth-nav-flex-links a:hover {
    color: #0ea5e9 !important;
  }
</style>
</head>
<body>

<div class="auth-fullscreen-wrapper">
  <div class="auth-custom-card">
    <h2>FORGOT PASSWORD</h2>
    <p class="subtitle">Recover Admin Account Access</p>
    
    <form action="" method="post">
      <div class="input-group-custom">
        <i class="fa fa-envelope"></i>
        <input type="email" name="email" placeholder="Registered Email ID" required="true" autocomplete="off">
      </div>
      
      <div class="input-group-custom">
        <i class="fa fa-phone"></i>
        <input type="text" name="contactno" placeholder="Mobile Number" required="true">
      </div>
      
      <button type="submit" name="submit">RESET PASSWORD</button>
    </form>
    
    <div class="auth-nav-flex-links">
      <a href="login.php"><i class="fa fa-sign-in"></i> Login Screen</a>
      <a href="../index.php"><i class="fa fa-home"></i> Home Page</a>
    </div>
  </div>
</div>

</body>
</html>