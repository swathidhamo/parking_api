<html>
<head>
<?php

                 
                 $username = $_POST["username"];
                 echo $username;
                 $get_pref = "SELECT pref_one, pref_two FROM auth WHERE username = '".$username."'";
                 $query_pref = mysqli_query($link, $get_pref);
                 $pref = mysqli_fetch_assoc($query_pref);
                 $pref_one = $pref["pref_one"]; 
                 $pref_two = $pref["pref_two"];
        
                
                $query = "SELECT name, description, kind FROM stores";
                $sql = mysqli_query($link,$query);











?>	
</head>

</html>