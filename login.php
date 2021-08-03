<?php
session_start();
include("connection/db.php"); 
if(isset($_POST['submit']))   
{
	$email = $_POST['email']; 
	$password = md5($_POST['password']);
        $loginquery_res ="SELECT * FROM restaurant WHERE resturant_email='$email' && resturant_password='$password'"; 
        // echo $loginquery_res;
	$result_res=mysqli_query($db, $loginquery_res); 
    $row_res=mysqli_fetch_array($result_res);
    $count_res = mysqli_num_rows($result_res);
    
    if($count_res==0){
        $message="No Credentials Found.....Please Register";
    }


       
    else if($count_res==1){
        // session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION['sess_user']=$email;
        //  $_SESSION["pass"] = $pass; 
        $succes = "Logged in Successfully";
        header('refresh:1; url=restaurant/index.php');
        
    }  
	 
	
	
}

else if(isset($_POST['cust_submit'])){
    $email = $_POST['email']; 
	$password = md5($_POST['password']);
    $loginquery_customer ="SELECT * FROM customer WHERE customer_email='$email' && customer_password='$password'"; 
    // echo $loginquery_customer;
	$result1=mysqli_query($db, $loginquery_customer); 
    $row=mysqli_fetch_array($result1);
    $count_cust = mysqli_num_rows($result1);
    if($count_cust==0){
        $message="No Credentials Found.....Please Register";
    }


       
    if($count_cust==1){
        // session_start();
         $_SESSION["login"] = true;
         $_SESSION['sess_user_cust']=$email;
        //  $_SESSION["pass"] = $pass; 
        $succes = "Logged in Successfully";
        header('refresh:1; url=./index.php');
        
    }  
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Food Delivery Assignment</title>    
<!-- vendors -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- main CSS -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
 <?php include 'includes/nav.php'?>
    
<!--------------banner section-------------->   
    


<div class="container mt-2 mb-4 login-box">
  <div class="col-sm-8 ml-auto mr-auto">
    <ul class="nav nav-pills nav-fill mb-1" id="pills-tab" role="tablist">
      <li class="nav-item"> <a class="nav-link active" id="pills-signin-tab" data-toggle="pill" href="#pills-signin" role="tab" aria-controls="pills-signin" aria-selected="true">Restaurant Sign In</a> </li>
      <li class="nav-item"> <a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="false">Customer Sign In</a> </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-signin" role="tabpanel" aria-labelledby="pills-signin-tab">
        <div class="col-sm-12 border border-primary shadow rounded pt-2">
        <span style="color:red;"><?php echo $message; ?></span> 
        <span style="color:green;"><?php echo $succes; ?></span> 

          <div class="text-center"><img src="assets/images/dish.png" class="img-fluid"></div>
          <form method="post" action="" id="singninFrom">
            <div class="form-group">
              <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter valid email" required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" id="password" class="form-control" placeholder="***********" required>
            </div>
            <div class="form-group">
              <div class="row">
                
                <div class="col text-right"> <a href="register.php">Register Here?</a> </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Sign In" class="btn btn-block btn-primary">
            </div>
          </form>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
        <div class="col-sm-12 border border-primary shadow rounded pt-2">
        <span style="color:red;"><?php echo $message; ?></span> 
        <span style="color:green;"><?php echo $succes; ?></span> 

          <div class="text-center"><img src="assets/images/dish.png" class="img-fluid"></div>
          <form method="post" action="" id="singnupFrom">
            <div class="form-group">
              <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
              <input type="email" name="email" id="signupemail" class="form-control" placeholder="Enter valid email" required>
            </div>
           
           
            <div class="form-group">
              <label class="font-weight-bold">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" id="signuppassword" class="form-control" placeholder="***********"
                required>
            </div>
            <div class="form-group">
              <div class="row">
                
              <div class="col text-right"> <a href="register.php">Register Here?</a> </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" name="cust_submit" value="Submit" class="btn btn-block btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!------------footer section ------------>   
<?php include 'includes/footer.php'?>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='assets/js/login.js'></script> -->
</body>
</html>