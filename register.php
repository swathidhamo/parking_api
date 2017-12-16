<html>
<head>
	<title>Parking app-Registration page</title>
	<?php
      
      require_once 'connect.php';

     if(!$link){
      echo "Could not connect";
      echo mysqli_error($link);
     }
     else{
      echo "Sucesssfully connected";

      if(isset($_POST["register"])){
      	if(isset($_POST["username"])){
      		$username = mysqli_real_escape_string($link,$_POST["username"]);
          $username = stripslashes($username);

      	}
      	if(isset($_POST["password"])){
      		$password = mysqli_real_escape_string($link,$_POST["password"]);
          $password = stripslashes($password);

      	}
          if(isset($_POST["serial"])){
          $serial = mysqli_real_escape_string($link,$_POST["serial"]);
          $serial = stripslashes($serial);

        }
          if(isset($_POST["size"])){
          $size = mysqli_real_escape_string($link,$_POST["size"]);
          $size = stripslashes($size);

        }
         if(isset($_POST["gender"])){
          $gender = mysqli_real_escape_string($link,$_POST["gender"]);
          $gender = stripslashes($gender);

        }

        $password_hash = hash('md5',$password);

        $query = "INSERT INTO auth(username,password, car_reg, car_size, gender) VALUES (?,?,?,?,?)";
        $sql = mysqli_prepare($link,$query);
        mysqli_stmt_bind_param($sql,"sssii",$username,$password_hash,$serial, $size,$gender);
        $result = mysqli_stmt_execute($sql);
        if($result ){
        header("Location: login.php");
      }
      else{
        echo mysqli_error($link);
      }
      	
      }
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
    <input type = "submit" name = "register" value = "Signup">
  </form>

</body>
</html>