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
        //    $food_type = trim($_POST['food_type']);
           $restaurant_id = trim($_POST['restaurant_id']);
		
				
												
                                            

												$sql = "INSERT INTO `menu`(`menu_name`,`fk_food_preference_id`, `price`, `fk_food_category_id`, `fk_food_type_id`, `fk_restaurant_id`) VALUES ('$name','$food_preference', '$price','$food_category', '$chk', '$restaurant_id')";
                                                
                                                echo $sql;
												mysqli_query($db, $sql); 
												header("Location:./menu.php");

	
	
	

}








?>