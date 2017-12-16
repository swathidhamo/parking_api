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
                else{
                  $response['error'] = true;
                  $response['message'] = 'Cannot register';
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
                    $response['message'] = 'Invalid username/password';

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
                   $response['message'] = 'Your car is already occupying a slot';
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
                         $response['message'] = 'Slot for your car is '.$array['slot'].' ';
                    }
                    else{
                          echo mysqli_error($link);
                          $response['error'] = true;
                         $response['message'] = 'Cannot process request';
                    }

                  }
                  else{
                    $response['error'] = true;
                    $response['message'] = "No slot is currently avaliable";

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
                   $response['message'] = 'Your car is occupying slot '.$array['slot'].
                   ' ';
                }
                else{
                   $response['error'] = true;
                   $response['message'] = 'Unable to locate your car, please try again ';


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
                    $cost = "SELECT start_time FROM mall WHERE username = '".$username."' ";
                    $query = mysqli_query($link, $cost);
                    $array = mysqli_fetch_assoc($query);
                    $diff = strtotime($time)-strtotime($array['start_time']);
                    $cost = $diff*.001;


                    $update = "UPDATE mall SET username = '".$name."',
                    occupied = 1, end_time = '".$time."'   WHERE username = '" .$username. "'";
                    $query_update = mysqli_query($link, $update);


                    if($query_update){
                         $response['error'] = false;
                         $response['message'] = 'Thank you for visiting us ! Rs.
                           '.$cost.' is the cost';


                }
            }
                else{

                    $response['error'] = true;
                    $response['message'] = "No slot is there";
                }
            }

            break;

            case 'bring_offers': 
            /*
                * 1=>cosmetics
                * 2=>clothing
                * 3=>food
                * 4=>electronics 
                * 5=>addons
            */
            if(checkIfAllParametersAreTrue(array('username','lng','lat'))){
                require_once 'offer.php';
                if($sql){
                while($result = mysqli_fetch_assoc($sql)){
                     if($result["kind"]==$pref_one){
                         $response['error'] = false;
                         $response['message'] = 'Hurry up while there is an offer near you !
                          '.$result["description"].' at '.$result["name"];
                     }
                     else if($result["kind"]==$pref_two){
                         $response['error'] = false;
                         $response['message'] = 'Hurry up while there is an offer near you !
                          '.$result["description"].' at '.$result["name"];
                     }
                     else{
                         $response['error'] = true;
                         $response['message'] = 'No offers near you now !';
                         }
                
                       }
   
                    }
            
                 }
           else{
                  $response['error'] = true;
                  $response['lat'] = $_POST["lat"] + 3.0;
                  $response['lng'] = $_POST["lng"] + 3.0;
                  $response['username'] = $_POST["username"];
                  $response['message'] = "All necessary parameters are not there";
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
