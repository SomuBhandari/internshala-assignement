<?php
  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    header("location: ../login.php");
    exit;
  } 
 

  ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Food Delivery Assignment</title>    
<!-- vendors -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- main CSS -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
 <?php include 'includes/nav.php'?>

 <?php include 'connection/db.php'?>

    
<!--------------banner section-------------->   
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Restaurant Dashboard </h1>
            </div>
            
        </div>
    </div>
</header>
<section id="main">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12">
              <h1>YOUR ORDERS</h1>
            <div class="panel panel-default">
              <div class="panel-body">
               
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Mobile</th>
                        <th scope="col">Menu Item</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Delivery Address</th>
                        <th scope="col">Order Time</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $get_clients = "SELECT * from orders o LEFT JOIN customer c on o.fk_customer_id = c.pk_customer_id LEFT JOIN menu m ON o.fk_menu_id = m.pk_menu_id where o.fk_restaurant_id = (SELECT pk_resturant_id from restaurant where resturant_email='{$_SESSION['sess_user']}' and is_active=1) and o.is_active=1 order by o. DESC
                    ";
                    $result = mysqli_query($db,$get_clients);
                    while($row = mysqli_fetch_array($result)){
                        echo '
                    <tr>
                    <th scope="row">'.$row['customer_name'].'</th>
                    <th scope="row">'.$row['customer_mobile_number'].'</th>
                    <th scope="row">'.$row['menu_name'].'</th>
                    <th scope="row">'.$row['price'].'</th>
                    <th scope="row">'.$row['quantity'].'</th>
                    <th scope="row">'.$row['delivery_address'].'</th>
                    <th scope="row">'.$row['order_time'].'</th>
                    </tr>
                    ';
                    }
?>
                </tbody>
            </table>
                
               
              </div>
              </div>

             
          </div>
        </div>
      </div>
    </section>

  

    
<!------------footer section ------------>   
<?php include 'includes/footer.php'?>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


</body>
</html>