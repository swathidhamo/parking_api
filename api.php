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