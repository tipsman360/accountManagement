<?php
//We get the value by POST Method & store them in variable
$email = $_POST['email'];
$password = $_POST['password'];
$key = $_POST['key'];

//We make a method name decryptData below for getting the encrypt value from app.
//We make this system so that anyOne can't access my PHP server without MyApp.
//By This system (if $security_key == 'myEncrypt value from App' ) MyServer only response when it call from my APP.
//Here we also decrypt email & password

$security_key = decryptData($key);
$decryptEmail = decryptData($email);

//Here we can don't decrypt the password beacause it can be view by hosting party
$decryptPassword = decryptData($password);

//Here we check security_key is ok or not, decryptEmail,decryptPassword length is bigger than 0 or not so that don't put empty entry
	if($security_key == 'mehedi04286' && strlen($decryptEmail)>0 && strlen($decryptPassword)>0){
		
	$connection = mysqli_connect("mysql-codingzone24.alwaysdata.net", "390236", "me72779673+*+*##", "codingzone24_user_table");
	
	//Here we check that duplicate mail is availabe or not so that two person can't make same account
	$sqlCommand1 = "SELECT * FROM db_userdata WHERE email = '$decryptEmail' AND password = '$decryptpassword'";
	$result1 = mysqli_query($connection, $sqlCommand1);
	$rows = mysqli_num_rows($result1);
	
	if($rows>0){
	echo 'Valid Login';
	}else{
		echo 'Login Error';
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
