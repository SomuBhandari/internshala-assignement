<?php
session_start();
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
<link rel="stylesheet" href="assets/css/menu.css">
</head>
<body>
 <?php include 'includes/nav.php'?>

 <?php include 'connection/db.php'?>
 <div class="container">

  
        <!-- products section -->

        <section id="products">
            <div class="container">
                <div class="row">
                    <!-- currencysorting start -->
    <?php
    
        if(isset($_SESSION['login'])){
            $all_menu_query = "select * from menu m join customer c 
    on m.fk_food_preference_id = c.fk_food_preference_id where c.customer_email='{$_SESSION['sess_user_cust']}'
   
                   ";
                   // echo $all_menu_query;
                   $result = mysqli_query($db, $all_menu_query);
    while($row = mysqli_fetch_array($result)){
            echo'
                    <div class="flower col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1" >
                       
                        <div class="card"> <img class="card-img-top img-fluid" src="./assets/images/dish.png">
                            <div class="card-body">
                                <h6 class="font-weight-bold pt-1"> '.$row['menu_name'].'</h6>
                               
                                <div class="d-flex align-items-center product">
                                <div class="text-muted description">Price:'.$row['price'].' </div>
                            </div>
                                <div class="d-flex align-items-center justify-content-center pt-3">
                                    
                                    <div class="btn btn-primary"> <a href="ordernow.php?id='.$row['menu_name'].'">Order now</a> </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>';
        }
        }

        else{
            $all_menu_query = "select * from menu";
                           // echo $all_menu_query;
                           $result = mysqli_query($db, $all_menu_query);
            while($row = mysqli_fetch_array($result)){
            echo'
                    <div class="flower col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1" >
                       
                        <div class="card"> <img class="card-img-top img-fluid" src="./assets/images/dish.png">
                            <div class="card-body">
                                <h6 class="font-weight-bold pt-1"> '.$row['menu_name'].'</h6>
                               
                                <div class="d-flex align-items-center product">
                                <div class="text-muted description">Price:'.$row['price'].' </div>
                            </div>
                                <div class="d-flex align-items-center justify-content-center pt-3">
                                    
                                <div class="btn btn-primary"> <a  href="#">Order Now</a> </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>';
        }

        
        
    }
                    ?>
    
    
    
    
    
    
    
                </div>
               
            </div>
        </section>
      </div>
<!------------footer section ------------>   
<?php include 'includes/footer.php'?>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


</body>
</html>