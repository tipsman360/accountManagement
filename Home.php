<?php
//Below line help us to get the input from JSONObject request
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$key = $data['key'];
$email = $data['email'];

$security_key = decryptData($key);

//Here we check security_key is ok or not, decryptEmail,decryptPassword length is bigger than 0 or not so that don't put empty entry
	if($security_key == 'mehedi04286' && strlen($decryptEmail)>0 && strlen($decryptPassword)>0){
		
	$connection = mysqli_connect("mysql-codingzone24.alwaysdata.net", "390236", "me72779673+*+*##", "codingzone24_user_table");
	
	//Here we check that duplicate mail is availabe or not so that two person can't make same account
	$sqlCommand1 = "SELECT * FROM db_userdata WHERE email LIKE '$decryptEmail' ";
	$output = mysqli_query($connection, $sqlCommand1);
	
	
	while ($row = mysqli_fetch_assoc($output)) { // Fixed the missing closing parenthesis
		$name = $row['name'];
		$image = $row['image'];
		$email = $row['email'];
	
		// Corrected variable concatenation
		$result = $name . ' - ' . $email;
	
		// Assigning values to the array properly
		$temp['result'] = $result;
		$temp['image'] = '//Directory where we put images/' . $image;
	
		// Do something with $temp (e.g., add it to a larger array)
		$data[] = $temp; // Collecting results in an array

		echo json_encode($data);

	}
	

		//After doing all work we should close the connection so that system will fine
		mysqli_close($connection);
		
		}//security_key if closing


function decryptData($text){
	$decode = base64_decode($text);
	$decrypted = openssl_decrypt($decode, 'AES-128-ECB', 'mehedi04286##**00', OPENSSL_RAW_DATA);
	return $decrypted;
}

?>
