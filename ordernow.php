<?php
session_start();
?>

<?php
 include 'connection/db.php';
if(isset($_POST['submit'])){

    $customer_id= trim($_POST['cid']);
    $res_id = trim($_POST['res']);
    $menu_id = trim($_POST['menu_id']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);
    $address = trim($_POST['address']);


    // echo $customer_id.'<br>';
    // echo $res_id.'<br>';
    // echo $menu_id.'<br>';
    // echo $price.'<br>';
    // echo $quantity.'<br>';
    // echo $address.'<br>';


    $add_order = "INSERT INTO `orders`(`fk_customer_id`, `fk_restaurant_id`, `fk_menu_id`, `quantity`, `delivery_address`, `order_time`) VALUES ('$customer_id','$res_id','$menu_id','$quantity','$address',NOW())";
    $add_order_query = mysqli_query($db, $add_order);
    // echo $add_order;
    if($add_order_query){
        $success = "Order Placed Successfully!!";
    } else{
        $message = "ERROR!! Please try again after sometime";
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
<link rel="stylesheet" href="assets/css/order.css">
</head>
<body>
 <?php include 'includes/nav.php'?>

 
 <div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						 <img src="./assets/images/dish.png" alt="">
						</div>
						
						
					</div>

                    <?php 
                    $menu_id=trim($_GET['id']);
                    // echo $menu_id;
                    
                    ?>
<div class="col-md-6">

<span style="color:red; text-align:center;"><?php echo $message; ?></span> 
                                            <span style="color:green; text-align:center;"><?php echo $success; ?></span> 
<form method="POST" action="">
      
     
      <div class="form-group">
        <label>Customer ID</label>
        <?php
        $query="select*from customer where customer_email = '{$_SESSION['sess_user_cust']}'";
        $res = mysqli_query($db, $query);
        while($row1 = mysqli_fetch_array($res)){
            echo

        '<input type="text" class="form-control" value="'.$row1['pk_customer_id'].'"  name="cid" readonly>';
        }
        ?>
      </div>
      <div class="form-group">
      <label>Prefered Restaurant:&nbsp;</label>
      <select name="res" class="form-control" id="res">
      <?php
      
      $all_menu_query = "select * from menu m JOIN restaurant r on m.fk_restaurant_id = r.pk_resturant_id where m.menu_name='$menu_id'";
      // echo $all_menu_query;
      $result = mysqli_query($db, $all_menu_query);

      while($row = mysqli_fetch_array($result)){
                  echo'
                  
<option class="form-control" value="'.$row['pk_resturant_id'].'">'.$row['resturant_name'].'</option>


                  
          ';}?>


  
  
      </select>
      
      </div>
      <?php
        $qu = "select * from menu m JOIN restaurant r on m.fk_restaurant_id = r.pk_resturant_id where m.menu_name='$menu_id'";
        // echo $all_menu_query;
        $resu = mysqli_query($db, $qu);

        $row2 = mysqli_fetch_array($resu);
       echo'
       <div class="form-group">
        <label>Menu ID</label>
        <input class="form-control" type="text" value="'.$row2['pk_menu_id'].'" name="menu_id">
      </div>
      <div class="form-group">
        <label>Price</label>
        <input class="form-control" type="text" value="'.$row2['price'].'" name="price">
      </div>';
      
      ?>
      <!-- <div class="form-group">
          <label class="control-label">Image</label>
          <input type="file" name="file"  id="lastName" class="form-control form-control-danger" placeholder="12n">
      </div> -->
      
      <div class="form-group">
          <label> Quantity:</label>
      
                 
                      <input class="form-control" type="number" name="quantity" min=0 required>
      </div>

      <div class="form-group">
          <label>Address</label>
     

                      <textarea class="form-control" name="address" cols="50" ></textarea>
                  
              
              
      </div>
      
      
      <button type="submit" name='submit' class="btn btn-primary">Checkout</button>
    
     

      

    </div>
    
  </form>

</div>

				
			</div>
		</div>
	</div>
<!------------footer section ------------>   
<?php include 'includes/footer.php'?>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


</body>
</html>