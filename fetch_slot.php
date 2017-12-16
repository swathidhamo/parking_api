<html>
<head>

 
	<?php

     session_start();
    
     if(!$link){
      echo "Could not connect";
      echo mysqli_error($link);
     }
     else{
      echo "Sucesssfully connected";

     


        $username = $_POST['username'];
    
        $query = "SELECT * FROM mall WHERE size <= '".$size."' ORDER BY max_size ASC";
        $sql = mysqli_query($link,$query);       
        $array = mysqli_fetch_assoc($sql); 

        
        
        }

	?>


</head>


</html>