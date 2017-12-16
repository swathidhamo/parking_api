<html>
<head>
	<title>Code snippet forum-Login page</title>
 
	<?php

    
     if(!$link){
      echo "Could not connect";
      echo mysqli_error($link);
     }
     else{
      echo "Sucesssfully connected to the database";

     


         $username = $_POST['username'];
         $password_hash = md5($_POST['password']); 


     
        $query = "SELECT * FROM auth WHERE username = '".$username."' AND password = '".$password_hash."'";
        $sql = mysqli_query($link,$query);       
        $rows = mysqli_num_rows($sql);
        


      	
      

     }








	?>


</head>

<body>
  
</body>
</html>
