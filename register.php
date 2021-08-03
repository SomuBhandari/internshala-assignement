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
<link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
 <?php include 'includes/nav.php'?>
    
<!--------------banner section-------------->   
    

<?php

include("connection/db.php"); //INCLUDE CONNECTION

if(isset($_POST['restaurant_submit'])){
    $restaurant_name = trim($_POST['restaurant_name']);
    $restaurant_email = trim($_POST['restaurant_email']);
    $restaurant_phone = trim($_POST['restaurant_phone']);
    $password = trim(md5($_POST['password']));
    $cpass = trim(md5($_POST['cpass']));
    $restaurant_address = trim($_POST['restaurant_address']);

    if($password==$cpass){

        $check_duplicate_restaurant = mysqli_query($db, "SELECT*FROM restaurant where resturant_name='$restaurant_name'");
        $count_res = mysqli_num_rows($check_duplicate_restaurant);
        if($count_res>=1){
            $errmessage = "Restaurant already exists";
        }
        else{
            $restaurant_insert = "INSERT INTO `restaurant`(`resturant_name`, `resturant_email`, `resturant_password`, `resturant_mobile_number`, `resturant_address`) VALUES ('$restaurant_name','$restaurant_email','$password','$restaurant_phone','$restaurant_address')";
            echo $restaurant_insert;
            $insert_query = mysqli_query($db, $restaurant_insert);
    
            if($insert_query){
                $successmessage="Successfully Registered";
            }
            else{
                $errmessage="Registration failed! Try Again after sometime!";
            }
        }
       
    }
    else{
        $errmessage="Password do not match";
    }
    

}
else if(isset($_POST['customer_submit'])){
    $customer_name = trim($_POST['customer_name']);
    $customer_email = trim($_POST['customer_email']);
    $food_preference = trim($_POST['food_preference']);
    $customer_pass = trim(md5($_POST['customer_pass']));
    $customer_cpass = trim(md5($_POST['customer_cpass']));
    $customer_phone = trim($_POST['customer_phone']);


    if($customer_pass==$customer_cpass){

        $check_duplicate_customer = mysqli_query($db, "SELECT*FROM customer where customer_name='$customer_name' and customer_email='$customer_email' and customer_mobile_number='$customer_mobile_number");
        $count_cust = mysqli_num_rows($check_duplicate_customer);
        if($count_cust>=1){
            $errmessage = "Customer exists already exists";
        }
        else{
            $customer_insert = "INSERT INTO `customer`(`customer_name`, `customer_email`, `customer_password`, `customer_mobile_number`, `fk_food_preference_id`) VALUES ('$customer_name','$customer_email','$customer_pass','$customer_phone','$food_preference')";
        echo $customer_insert;
        $insert_query_cust = mysqli_query($db, $customer_insert);

        if($insert_query_cust){
            $successmessage="Successfully Registered";
        }
        else{
            $errmessage="Registration failed! Try Again after sometime!";
        }
        }
        
    }
    else{
        $errmessage="Password do not match";
    }
    

}
?>
  
  <div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>You are 30 seconds away from earning your own money!</p>
                        <input type="submit" name="" value="Login"/><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Restraunt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Customer</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Register your Restaurant</h3>
                               
                                    <form action="" method="post">
                                        <div class="row register-form">
                                            <div class="col-md-12">
                                            <span style="color:red; text-align:center;"><?php echo $errmessage; ?></span> 
                                            <span style="color:green; text-align:center;"><?php echo $successmessage; ?></span> 
                                            </div>
                                        
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <input type="text" name="restaurant_name" class="form-control" placeholder="Restaurant Name *" required/>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" name="restaurant_email" class="form-control" placeholder="Restaurant Email *" required/>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" minlength="10" maxlength="10" name="restaurant_phone" class="form-control" placeholder="Restaurant Phone *" required />
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <input type="password" name="password" class="form-control" placeholder="Password *" required/>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="cpass" class="form-control"  placeholder="Confirm Password *" required />
                                                </div>
                                                <div class="form-group">
                                                    <input type="textarea" name="restaurant_address" class="form-control" placeholder="Restaurant Address *" required />
                                                </div>
                                                
                                                
                                                <input type="submit" class="btnRegister"  name="restaurant_submit" value="Register"/>
                                            </div>
                                        </div>
                                    </form>
                                    
                                
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Register Yourself</h3>
                                
                                    <form action="" method="post">
                                        <div class="row register-form"> 
                                        <div class="col-md-12">
                                            <span style="color:red; text-align:center;"><?php echo $errmessage; ?></span> 
                                            <span style="color:green; text-align:center;"><?php echo $successmessage; ?></span> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="customer_name" placeholder="Full Name *" required />
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="customer_email"placeholder="Email *" required />
                                                </div>
                                                <div class="form-group">
                                                    <div class="maxl">
                                                    Preference:
                                                    <?php
                                                    $food_pref = mysqli_query($db, "select*from food_preference");
                                                    while($food_pref_res=mysqli_fetch_array($food_pref)){
                                                        echo'
                                                        <label class="radio inline"> 
                                                            <input type="radio" name="food_preference" value='.$food_pref_res["pk_food_preference_id"].' required>
                                                            <span> '.$food_pref_res["food_preference_name"].' </span> 
                                                        </label>
                                                        ';
                                                    }

                                                
                                                        ?>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <input type="text" maxlength="10" minlength="10" class="form-control" name="customer_phone" placeholder="Phone *" required />
                                                </div>
                                            
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="customer_pass" placeholder="Password *" required />
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="customer_cpass" placeholder="Confirm Password *" required />
                                                </div>
                                            
                                                <input type="submit" class="btnRegister"  name="customer_submit" value="Register"/>
                                            </div>
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


</body>
</html>