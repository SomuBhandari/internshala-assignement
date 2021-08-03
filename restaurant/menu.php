<?php
session_start();
include 'connection/db.php';

  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    header("location: ../login.php");
    exit;
  } 
 

  ?>

  <?php
if(isset($_POST['submit']))           //if upload btn is pressed
{
	
			
		
			
		  
		
		
	

           $name = trim($_POST['dname']);
           $food_preference = trim($_POST['food_preference']);
           $price = trim($_POST['price']);
           $food_category = trim($_POST['food_category']);
           $food_type = $_POST['food_type'];

foreach($food_type as $selected){
    // $selected;
    $chk .= $selected.",";  

    echo $chk;


}
$restaurant_id = trim($_POST['restaurant_id']);
		    $sql = "INSERT INTO `menu`(`menu_name`,`fk_food_preference_id`, `price`, `fk_food_category_id`, `fk_food_type_id`, `fk_restaurant_id`) VALUES ('$name','$food_preference', '$price','$food_category', '$chk', '$restaurant_id')";
                                                
                                                // echo $sql;
			mysqli_query($db, $sql); 
											

	
	
	

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

    
 

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Restaurant Dashboard </h1>
            </div>
            <div class="col-md-2">
                
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="modal" data-target="#addPage" aria-haspopup="true" aria-expanded="true">
                Add Menu Item
              </button>

  
            </div>
        </div>
    </div>
</header>

<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">Dashboard</li>
            <li>Menu</li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Latest Users -->
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                        <tr>
                          <th>Dish Name</th>
                          <th>Preference</th>
                          <th>Price</th>
                          <th>Image</th>
                          <th>Food Type</th>
                          <th>Food Category</th>
 
                          
                        </tr>
                         <?php
                
             
           
                $all_menu_query = "select m.*,fp.*,fc.*,ft.* from menu m LEFT JOIN 
                food_preference fp ON m.fk_food_preference_id = fp.pk_food_preference_id LEFT JOIN 
                food_category fc on m.fk_food_category_id = fc.pk_food_category_id LEFT JOIN 
                food_type ft on m.fk_food_type_id = ft.pk_food_type_id 
                where m.fk_restaurant_id = (SELECT pk_resturant_id from restaurant where resturant_email='{$_SESSION['sess_user']}')
                ";
                // echo $all_menu_query;
                $result = mysqli_query($db, $all_menu_query);
                while($row = mysqli_fetch_array($result)){

                    echo '<tr>
                    <td>'.$row['menu_name'].'</td>
                    <td>'.$row['food_preference_name'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>'.$row['food_image'].'</td>
                    <td>'.$row['food_type_name'].'</td>
                    <td>'.$row['food_category_name'].'</td>';
                    echo "</tr>";
                }
                ?>
                      </table>
                    </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Menu Item</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Dish Name</label>
          <input type="text" class="form-control" placeholder="Dish Name" name='dname' required>
        </div>
        <div class="form-group">
        <label>Food Preference:&nbsp;</label>
        <?php
        
                $food_pref = mysqli_query($db, "select*from food_preference");
                while($food_pref_res=mysqli_fetch_array($food_pref)){
                    echo'
                    <label class="radio-inline"> 
                        <input type="radio" name="food_preference" value='.$food_pref_res["pk_food_preference_id"].' required>
                        <span> '.$food_pref_res["food_preference_name"].' </span> 
                    </label>
                    ';
                }

    
        ?>
        
        </div>
        <div class="form-group">
          <label>Price</label>
          <input type="text" class="form-control" placeholder="Price" name='price'>
        </div>
        <!-- <div class="form-group">
            <label class="control-label">Image</label>
            <input type="file" name="file"  id="lastName" class="form-control form-control-danger" placeholder="12n">
        </div> -->
        
        <div class="form-group">
            <label> Food Category:</label>
        <?php
                $food_cat = mysqli_query($db, "select*from food_category");
                while($food_cat_res=mysqli_fetch_array($food_cat)){
                    echo'
                    <label class="radio-inline">
                        <input type="radio" name="food_category" value='.$food_cat_res["pk_food_category_id"].' required>
                        <span> '.$food_cat_res["food_category_name"].' </span> 
                    </label>
                    ';
                }

    
        ?>
        </div>

        <div class="form-group">
            <label>Food Type:</label>
        <?php
                $food_type = mysqli_query($db, "select*from food_type");
                while($food_type_res=mysqli_fetch_array($food_type)){
                    echo'
                    <label class="checkbox-inline"> 
                        <input type="checkbox" name="food_type[]" value='.$food_type_res["pk_food_type_id"].'>
                        <span> '.$food_type_res["food_type_name"].' </span> 
                    </label>
                    ';
                }

    
        ?>
        </div>
        

       

        <div class="form-group">
            <label class="control-label">Restaurant</label>
            <?php
            $res_find_quer="select*from restaurant where resturant_email='{$_SESSION['sess_user']}'";
            // echo $res_find_quer;
                $res_id_query = mysqli_query($db, $res_find_quer);

                $res_id=mysqli_fetch_array($res_id_query)
                ?>
            <input type="hidden" name="restaurant_id"  id="lastName" class="form-control form-control-danger" value="<?php echo $res_id['pk_resturant_id']?>" readonly>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name='submit' class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

  

    
<!------------footer section ------------>   
<?php include 'includes/footer.php'?>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


</body>
</html>