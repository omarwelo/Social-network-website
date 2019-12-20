

<html>
	<head lang="en-us">
		<title>social</title>
		                              <!--META TAGS -->
		<meta charset="utf-8" />
		<meta name="description" content="Connect with friends and pentesters and other people you know. Share photos and videos, send messages and get updates." />
		<meta name="keyword" content="flagx , flag , social , network , social network , connect , " />
		<meta name="author" content="Omar El Hadidi"  />
		<meta name="robots" content="index,follow" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />


										<!--LNIK TAGS -->
		<link rel="stylesheet" href="css/normalize.css" /> 
		<link rel="stylesheet" href ="css/bootstrap.min.css" />
		<link rel="stylesheet" href ="fonts/all.css" />				<!--FONTAWESOME CSS FILE -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/main.css" />
										<!--fav icons  -->
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon" href="">  						<!--APPLE FAVICONS -->

		
	</head>
	<body>

		<header>
			<h1 class="logo">flagx community</h1>

		</header>
		<main>
			<section>
				
				<i id="pic" class="fas fa-globe"></i>
				
				<div class="kalam">
				<h2 class="typed"></h2>
				</div>
				
			</section>
			<aside>
				<div class="content" id="remove-padding"> 
					<div id="pop" class="popup_error"></div>
					<h2>register</h2>
					<form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
						<div class="cont"> 
							<div class="error"> <i id="jsuser" class="fas fa-asterisk" aria-hidden="true"></i></div>
							<input type="text" name="username" placeholder="username"  autocomplete="off"/>
						</div> 
						<div class="cont"> 
							<div class="error"> <i id="jspass" class="fas fa-asterisk" aria-hidden="true"></i></div>
							<input type="password" name="password"  placeholder="password"  	/>
						</div>
						<div class="cont"> 
							<div class="error"> <i id="jspass2" class="fas fa-asterisk" aria-hidden="true"></i></div>
							<input type="password" name="password2"  placeholder="re-enter your password"   />
						</div>
						<div class="cont"> 
							<div class="error"> <i id="jsemail" class="fas fa-asterisk" aria-hidden="true"></i></div>
							<input type="email" name="email" placeholder="email" autocomplete="off"   />
						</div>
						<div class="remember">
							<label for="ma">male</label>
							<input type="radio" id="ma" name="gender" value="male" required/>
							<label for="fe">female </label>
							<input type="radio" id="fe" name="gender" value="female" required/>
							

						</div>
						
						<input type="submit" id="reg-page" name="register" value="register" />
						

					</form>
					<p><a href="index.php" target="_self">already have an account?</a></p>
				</div>

			</aside>
		</main>
		

			<script src="js/all.js" ></script>						<!--fontawesome js file -->
			<script src="js/jquery.js"></script>
			<script src="js/typed.min.js"></script>
			<script src="js/main.js" ></script>
			<script type="text/javascript">
				
				var typed = new Typed('.typed', {
				  strings: ["welcome pentesters ..." ],
				  loop:true,
				  typeSpeed: 100,
				  backSpeed:100,
				  backDelay:2000
				});
			</script>
	</body>



</html>



<?php 


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){

	require 'db_connection.php';

	//initializing variables

	$name="";
	$password="";
	$password2="";
	$email="";
	$gender="";
	$error = array();
	$count=0;

	//validating inputs
	function test_input ($data){

		$data=trim($data);
		$data=strip_tags($data);
		$data=htmlspecialchars($data);
		return $data;

	}

	if (empty($_POST['username'])){

		
		$count++;
		echo "<script>document.getElementById('jsuser').style.color='#E4324C';</script>";
		
	}
	else {
			$name=test_input($_POST['username']);

			$sql="SELECT * FROM users WHERE username = '$name' ";

			if ($stmt = $conn->prepare($sql)) {
			// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
			
		 		$query=mysqli_query($conn,$sql);
				$num_of_rows=mysqli_affected_rows($conn);					
				$row=mysqli_fetch_assoc($query);
		 		//$stmt->store_result();
				// Store the result so we can check if the account exists in the database.
				if ($num_of_rows > 0) {
						// Username already exists
					echo 'Username exists, please choose another!';
						
			 	} 
			  $stmt->close();

		 	} else {
			 	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			 	echo 'Could not prepare statement!';
			 }
			

		
	}
	if (empty($_POST['password'])){

		
		$count++;
		echo "<script>document.getElementById('jspass').style.color='#E4324C';</script>";
	}
	else {

		 // if (strlen($password) < 8) {

	 		 

	 	// 	 $error[1]= "please choose a long pass more than 8 chars";
	 	// 	$count++;

			// }
		
				$password=test_input($_POST['password']);
				$password=md5($password);
			

		
		
	}
	if (empty($_POST['password2'])){

		
		$count++;
		echo "<script>document.getElementById('jspass2').style.color='#E4324C';</script>";
		
	}
	else {

		$password2=test_input($_POST['password2']);
		$password2=md5($password2);
		
	}
	if ($password !== $password2){

		$error[0]= "password does'nt match";
		$count++;
		
	}
	
	if (empty($_POST['email'])){

		
		$count++;
		echo "<script>document.getElementById('jsemail').style.color='#E4324C';</script>";
	}
	else {
		$email=test_input($_POST['email']);
			
		if (!filter_var($email , FILTER_VALIDATE_EMAIL)){
			$error[2]= "please enter a valid email ";
			$count++;
			
		}
		
	}
	if (empty($_POST['gender'])){

		$error[3]= "gender is required"."</br>";
		$count++;

	}
	else {
		$gender=test_input($_POST['gender']);
		
	}


	

 

//showing error
	if ($count>0){
		echo "<script>
		 	document.getElementById('pop').style.visibility='visible' </script> ";
		 foreach ($error as $i){
		 echo "<script>
		 	document.getElementById('pop').innerHTML = '$i'  </script>";
		 }
	}
	else {
		
		
	 	//prepare and bind

	 		 $sql="INSERT INTO users (username, password, email, gender) 
	 		 	VALUES (?, ?, ?, ?)";

	 			if($stmt = $conn->prepare($sql)){

		 			$stmt->bind_param('ssss',$name,$password,$email,$gender);

		 			//binding variables
		 			

		 			if($stmt->execute()){
		 				
					
						$q ="SELECT * FROM users WHERE 'username'='$name' ";
								$queryy=mysqli_query($conn,$q);
								$num_of_rowss=mysqli_affected_rows($conn);
								$row=mysqli_fetch_assoc($queryy);
								session_start();
								
							 $_SESSION["username"] = $row['username'];
							 $_SESSION["id"] = $row['user_id'];
							

						echo "<script>window.location='index.php';</script>";
					}
					else {
						echo "coudnt execute";
					}
				} else {
						// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
						echo 'Could not prepare statement!';
				}

		 			//close connection
		 			$stmt->close();
		 			$conn->close();	
		 		

	 		
	}
	












}
/*else {


	echo "<h1 style='text-align:center;font-weight:bold;font-size:50px'>Forbidden</h1> " ."<hr>"."<p style='text-align:center'>you Cannot Access This Page</p>";
}
*/
?>