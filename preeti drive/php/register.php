<?php

require("db.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$pattern = "1234567890";

	$length = strlen($pattern)-1;
	$v_code = [];
	for($i=0;$i<6;$i++)
	{
		$index = rand(0,$length);
		$v_code[] = $pattern[$index];
	}

	$ver_code = implode($v_code);

	$full_name = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$check = "SELECT email FROM user_inf WHERE email = '$email'";
	$response = $db->query($check);
	if($response->num_rows != 0)
	{
		echo "usermatch";
	}
	else
	{
		$send_atc = mail($email, "Activation Code", "Thank You For Using Our Product Your Activation Code is ".$ver_code,"From: ps7379791@gmail.com");
		if($send_atc)
		{
			$store = "INSERT INTO user_inf(full_name,email,password,activation_code)
			VALUES('$full_name','$email','$password','$ver_code')";
	
			if($db->query($store))
			{
				echo "success";
			}
			else
			{
				echo "failed";
			}
		}
		else
		{
			echo "Try again with other Email Id";
		}
	}

}
else
{
	echo "User unauthorized";
}

?>