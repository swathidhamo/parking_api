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
         $size = $_POST['car_size']; 
         $serial = $_POST['car_reg']; 
         $password_hash = md5($_POST['password']);
         $gender = $_POST['gender']; 
         $mobile_number = $_POST['mobile_number']; 
 


      //  $password_hash = hash('md5',$password);

        $query = "INSERT INTO auth(username,password, car_reg, car_size, mobile_number, gender) VALUES (?,?,?,?,?,?)";
        $sql = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($sql,"sssisi",$username,$password_hash,$serial, $size,$mobile_number, $gender);
        $result = mysqli_stmt_execute($sql);
      
      	
      
    }
     






	?>
</head>
<body>
  <form method = "POST" >
    Username: <input type = "text" name = "username" placeholder = 'Enter the username'>
    Password: <input type = "text" name = "password" placeholder = "Enter the password">
    Car registration number: <input type = "text" name = "serial" placeholder = "Enter the registration number">
    Car size: <input type = "number" name = "size" placeholder = "Enter the size">
    Gender: <input type = "number" name = "gender" placeholder = "Enter the gender">
    Mobile Number: <input type = "text" name = "mobile_number" placeholder = "Enter the phone number">
    <input type = "submit" name = "register" value = "Signup">
  </form>

</body>
</html>