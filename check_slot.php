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
    
        $query = "SELECT * FROM mall WHERE username = '".$username."' ";
        $sql = mysqli_query($link,$query);  
             
        $rows = mysqli_num_rows($sql);

        
        }

	?>


</head>


</html>