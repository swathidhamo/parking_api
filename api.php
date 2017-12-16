<html>
<head>
    <title></title>
    <?php
    require_once 'connect.php';

    //array to display the result
    $response = array();
    /*api call is symbolized by a GET parameter
     called 'apicall' */
    if(isset($_GET['apicall'])){
        switch($_GET['apicall']){
            case 'signup':
            //will be the register page
            if(checkIfAllParametersAreTrue(array('username', 'password','gender','mobile_number',
                'car_reg', 'car_size') ) ){
                require_once 'register.php';
                if($result){
                    $response['error'] = false; 
                    $response['message'] = 'User registered successfully'; 
                    $response['user'] = $username;
                }
            }
                else{
                    $response['error'] = true; 
                    $response['message'] = 'Parameters unavaliable'; 
                } 
            
            break; 
            case 'login':
            //will be the login part
            if(checkIfAllParametersAreTrue(array('username','password'))){
                require_once 'login.php';
                if($rows==1){
                    $response['error'] = false; 
                    $response['message'] = 'User successfully logged in'; 
                    $response['car_size'] = $password_hash; 
                    $response['user'] = $username;
                }
                else{
                    $response['error'] = true; 
                    $response['message'] = 'User unsuccessful'; 
                    
                }
            }
            break;

            case 'book_slot':
            if(checkIfAllParametersAreTrue(array('username'))){
                //require_once 'check_slot.php';
                    $username = $_POST['username'];
                    $query = "SELECT * FROM mall WHERE username = '".$username."' ";
                    $sql = mysqli_query($link,$query);  
                    $rows = mysqli_num_rows($sql);
                if($rows>0){
                   $response['error'] = true; 
                   $response['message'] = 'Car is already occupying a slot';  
                }
                else{
                 $size = 2; 
               //  require_once 'fetch_slot.php';

                 $username = $_POST['username'];
                 $query = "SELECT slot FROM mall WHERE max_size <= 3 AND 
                 occupied = 1 ORDER BY max_size ASC LIMIT 1";
                 $sql = mysqli_query($link,$query);  
                 $array = mysqli_fetch_assoc($sql);     

                  if($sql){
                   
                    date_default_timezone_set("Asia/Kolkata");
                    $time = date('Y-m-d H:i:s'); 
                   
                    $update = "UPDATE mall SET username = '".$username."', 
                    occupied = 2, start_time = '".$time."'   WHERE slot = '" .$array['slot']. "'"; 
                    $query_update = mysqli_query($link, $update);
                    if($query_update){
                         $response['error'] = false; 
                         $response['message'] = 'Slot fetched for your car is '.$array['slot'].' Have a good time !'; 
                    }
                    else{
                          echo mysqli_error($link);
                          $response['error'] = true; 
                         $response['message'] = 'Cannot process request'; 
                    }
                    
                  }
                  else{
                    $response['error'] = true;
                    $response['message'] = "No slot is there";

                  }
                  
                }
            }

            break;
            case 'fetch_slot':
                if(checkIfAllParametersAreTrue(array('username'))){
                //require_once 'check_slot.php';
                    $username = $_POST['username'];
                    $query = "SELECT slot FROM mall WHERE username = '".$username."' ";
                    $sql = mysqli_query($link,$query);  
                    $rows = mysqli_num_rows($sql);
                    $array = mysqli_fetch_assoc($sql); 

                if($rows>0){
                   $response['error'] = false; 
                   $response['message'] = 'Car is occupying slot '.$array['slot'].
                   '  Thank you for visiting';  
                }
                else{
                   $response['error'] = true; 
                   $response['message'] = 'No slot found ';  

                  
                }
            }

            break;

            case 'end_slot':
              if(checkIfAllParametersAreTrue(array('username'))){
                //require_once 'check_slot.php';
                    $username = $_POST['username'];
                    $query = "SELECT * FROM mall WHERE username = '".$username."' ";
                    $sql = mysqli_query($link,$query);  
                    $rows = mysqli_num_rows($sql);
                if($rows>0){
                    $name = "none";
                      date_default_timezone_set("Asia/Kolkata");
                    $time = date('Y-m-d H:i:s'); 
                    $update = "UPDATE mall SET username = '".$name."', 
                    occupied = 1, end_time = '".$time."'   WHERE username = '" .$username. "'"; 
                    $query_update = mysqli_query($link, $update);
                    if($query_update){
                         $response['error'] = false; 
                         $response['message'] = 'Goodbye';
                   
                    
                }
            }
                else{
                  
                    $response['error'] = true;
                    $response['message'] = "No slot is there";
                }
            }
          
            break;

            default:
            $response['error'] = true; 
            $response['message'] = 'Invalid operation called'; 
        }
    }

    else{
            $response['error'] = true; 
            $response['message'] = 'Invalid API call'; 
    }


    echo json_encode($response);
    function checkIfAllParametersAreTrue($params){
        foreach($params as $param){
            if(!isset($_POST[$param])){
                return false; 
            }

        }
        return true; //only if all are true 
    }






    ?>
</head>
<body>

</body>
</html>