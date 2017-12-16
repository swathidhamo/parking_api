<html>
<head>
<?php

                 $latbgn = $_POST["lat"] - 3.0;
                 $latend = $_POST["lat"] + 3.0;
                 $lngbgn = $_POST["lng"] - 3.0;
                 $lngend = $_POST["lng"] + 3.0;
                 $username = $_POST["username"];
                 $get_pref = "SELECT pref_one, pref_two FROM auth WHERE username = '".$username."'"
                 $query_pref = mysqli_query($link, $get_pref);
                 $pref = mysqli_fetch_assoc($query_pref);
                 $pref_one = $pref["pref_one"]; 
                 $pref_two = $pref["pref_two"];
                 echo $pref_one;
                
                $query = "SELECT name, description, kind FROM stores WHERE lat >=  '".$latbgn."' AND 
                lng <= '".$lngend."' AND lat <= '".$latend."' AND lng >='".$lngbgn."' ";
                $sql = mysqli_query($link,$query);











?>	
</head>

</html>