<html>
<head>
	<title>Parking app-Registration page</title>
	<?php
      
      //require_once 'connect.php';

     if(!$link){
      echo "Could not connect";
      echo mysqli_error($link);
     }
     else{
      echo "Sucesssfully connected";

    
         $username = $_POST['username']; 
         $name_car = $_POST['car_size']; 
         $serial = $_POST['car_reg']; 
         $password_hash = md5($_POST['password']);
         $gender_name = $_POST['gender']; 
         $mobile_number = $_POST['mobile_number']; 
         if($name_car=="Hatch Back"){
              $size = 1; 
         }
         else if($name_car=="Sedan"){
              $size = 2; 
         }
         else{
          $size = 3; 
         }

         if($gender_name=="Female"){
            $gender = 2; 
         }
         else{
            $gender = 1; 
         }


 

          
      //  $password_hash = hash('md5',$password);

        $query = "INSERT INTO auth(username,password, car_reg, car_size, mobile_number, gender,pref_one,pref_two)
         VALUES (?,?,?,?,?,?,'','')";
        $sql = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($sql,"sssisi",$username,$password_hash,$serial, $size,$mobile_number
          , $gender);
        $result = mysqli_stmt_execute($sql);
      
      	
      
    }
     






	?>
</head>
<body>


</body>
</html>