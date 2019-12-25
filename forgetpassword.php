

<html>
	<head>
		<title>FlagX</title>
								<!--meta tags-->
		<meta charset="utf-8" />
		<meta name="description" content="Connect with friends and pentesters and other people you know. Share photos and videos, send messages and get updates." />
		<meta name="keyword" content="flagx , flag , social , network , social network , connect , " />
		<meta name="author" content="Omar El Hadidi"  />
		<meta name="robots" content="noindex,nofollow" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />

		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		
		<link rel="apple-touch-icon" href="favicon.ico">  				<!--APPLE FAVICONS -->

								<!--page style-->
		<style>
			
			fieldset {
				border:2px solid #E44D3A !important;
				height:450px;
			}
			legend {
				background-color:#E44D3A;
				color:#fff;
				width:150px;
				padding:15px 0 15px 20px;

			}
			form input {

				width:20%;
				height:40px;
				margin-left:40px;
				padding-left:10px;
			}
		</style>
		
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<fieldset>
				<legend>Forget your password</legend>
				<label for="mail">Please enter your username:</label>
				<input type="email" id="mail" name="email" placeholder="please enter your email" required/>
				<input type="submit" name="submit" value="submit" />
			</fieldset>
		</form>
	</body>
</html>


<?php 
	
	


	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){

		//variables 
		$count =0;
		$email="";

		//test input fn
		function test_input ($data){

			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		if (isset($_POST['email'])){

			$email=test_input($_POST['email']);
			if (!filter_var($email , FILTER_VALIDATE_EMAIL)){
				echo "please enter a valid email";
				$count++;
			}
		}
		else {
			echo "email field is required";
			$count++;
		}



		if ($count >0){
			echo"error";
			exit();
		}


		//connection to db
		require 'db_connection.php';

		$sql="SELECT * FROM users WHERE email = '$email' ";

			if ($stmt = $conn->prepare($sql)) {
			
			
		 		$query=mysqli_query($conn,$sql);
				$num_of_rows=mysqli_affected_rows($conn);					
				$row=mysqli_fetch_assoc($query);
		 		//$stmt->store_result();
				// Store the result so we can check if the account exists in the database.
				if ($num_of_rows == 0) {
						// Username already exists
					echo 'No email found , Please enter a registerd Mail ';
						exit();
			 	} 
			 	else {
			 		echo "sent please check your email";
			 		echo $row['password'];
			 	// 	$to = $email;
					// $subject = "Flagx recovery Password";

					// $message = "
					// <html>
					// <body>
					// 	<h1>HI xxxxxxxx </h1>
					// 	<p>we are very sorry that you forget your password .</p>

					// 	 <p>your password is </p>


					// </body>
					// </html>
					// ";

					// // Always set content-type when sending HTML email
					// $headers = "MIME-Version: 1.0" . "\r\n";
					// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// // More headers
					// $headers .= 'From: <omarwhadidi@hotmail.com>' . "\r\n";
					// $headers .= 'Cc: myboss@example.com' . "\r\n";

					//mail($to,$subject,$message,$headers);
					//no smtp server in localhost
					
					sleep(5);
					header('location:index.php');
			 	}
			 

		 	} else {
			 	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			 	echo 'Could not prepare statement!';
			 }
			
			 $stmt->close();
			 $conn->close();


		

	}

?>