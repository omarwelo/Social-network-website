
 <?php 

 	 session_start();
 	  if (!isset($_SESSION['username'])){
 	 		header('location:index.php');
 	 		exit; 
 	 		/*use exit or die to stop executing the page  
 	 		  because if i use curl <url> command it will display the page
 	 		  so to prevent that use exit or die after the redirect */
 	  }
 	require 'db_connection.php';
 /*
	if (!header("referrer:index.php")){
			
			header("location:index.php");
	} */

?> 

<!DOCTYPE html >
<html>
	<head lang="en-us">
		<title>Flagx</title>
		                              <!--META TAGS -->
		<meta charset="utf-8" />
		<meta name="description" content="Connect with friends and pentesters and other people you know. Share photos and videos, send messages and get updates." />
		<meta name="keyword" content="flagx , flag , social , network , social network , connect , " />
		<meta name="author" content="omar El hadidi"  />
		<meta name="robots" content="index,follow" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />


										<!--LNIK TAGS -->
		<link rel="stylesheet" href="css/normalize.css" /> 
		<link rel="stylesheet" href ="css/bootstrap.min.css" />
		<link rel="stylesheet" href ="fonts/all.css" />		
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/page.css" type="text/css"/>
										<!--fav icons  -->
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		
		<link rel="apple-touch-icon" href="favicon.ico">  						<!--APPLE FAVICONS -->


		
	</head>
	<body>
		<header>
			<div class="site_name">
				<h1>flagX</h1>
			</div>
			<div class="search">
				<form method="post" action="">
					<input type="text" name="serch" placeholder="search..." />
					<button type="submit"><i  class="overwride fas fa-search"></i></button>
				</form>
			</div>
			<nav>
				<li><a href="#" target="_self">home</a></li>
				<li><a href="profile.php" target="_self">profile</a></li>
				<li><a href="logout.php" target="_self">logout</a></li>
			</nav>
		</header>
		<div class="contain">
				<div class="wrapper">
											<!-- left side bar start -->
				<aside class="left">
					<section class="info">
						<div class="empty"></div>
						<div class="photo">
							<img src="images/noimage.png" alt="profile picture" title="profile picture" />
							<h3><?php echo $_SESSION['username'] ;?></h3>
							<p>web developper</p>
						</div>
						<div class="age">
								<?php	$sql ="SELECT * FROM users";
									$query=mysqli_query($conn,$sql);
									$num_of_rows=mysqli_affected_rows($conn);
									
										$row=mysqli_fetch_assoc($query);
										echo "<h3>age</h3>
												<p>".$row['age']."</p>
			
											</div>
											<div class='relationship'>
												<h3>relationship</h3>
												<p>".$row['relationship']."</p>";
							?>
						</div>
					</section>

					<section class="ads">
						
					</section>
				</aside>
												<!-- left side bar end  -->
												<!-- main section start  -->
				<main>
					<section class="first_section">
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<textarea id="aj" name="post" placeholder="What's on your mind?"></textarea>
							<input type="submit" name="share" value="post" onclick="share()"/>
						</form>
					</section>

						<?php	$sql ="SELECT * FROM posts";
						$query=mysqli_query($conn,$sql);
						$num_of_rows=mysqli_affected_rows($conn);
						
						for ($i=0;$i<$num_of_rows;$i++)
						{
							$row=mysqli_fetch_assoc($query);

							echo "

							<section>
								<div class='post'>
									<div class='time_post'>
										<img src='images/noimage.png' alt='profile photo' title='profile photo' />
										<p class='editp'>".$row['username']."</p>
										<p>".$row['post_time']."</p>
									</div>
									<div class='comment'>
									".
									$row['comment']."
									</div>
								</div>
								<div class='likes'>
									<div class='bt_like'>
										<button name='like' value='true'><i class='overwride2 fas fa-heart'></i>like</button>
										<div class='icon'>
											
										</div>
									</div>
								</div>
							</section>

							";
						}
						?>
				

					
			    </main>
			    									<!-- main section end  -->
			    									<!-- right side bar  -->
				<aside class="right">
					<section class="top_right">
						<p>welcome</p>
						<p><?php echo $_SESSION['username'] ;?></p>
						<p>to flagx</p>
						<a href="edit.php" target="_blank">edit your profile</a>
					</section>
					<section class="ads">
						
					</section>

				</aside>
			</div>
		</div>

			<script src="js/all.js" ></script>						<!--fontawesome js file -->
			<script src="js/jquery.js"></script>
			<script>
				
				function share() {
				  
				  
				   var cm= document.getElementById("aj").value ;
				  
				  var xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    document.getElementById("comment").innerHTML = this.responseText;
				    }
				  };
				  xhttp.open("POST", "home.php", true);
				  xhttp.send();
				}
			</script>
	</body>
</html>

<?php 
		
		

		if (isset($_POST['share'])){

				// validation function
				function test_input ($data){

				$data=trim($data);
				$data=strip_tags($data);
				$data=htmlspecialchars($data);
				return $data;

				}

				if (!empty($_POST['post'])){
					$user_post=test_input($_POST['post']);
				}
						
				$date=date("F d, Y h:i:s A");

				

				$sql="INSERT INTO posts (comment ,post_time,username) 
	 		 	VALUES (? ,?,?)";

	 			if($stmt = $conn->prepare($sql)){

		 			$stmt->bind_param('sss',$user_post,$date,$_SESSION['username']);
		 			

		 			$stmt->execute();
					
					
				} else {
						// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
						echo 'Could not prepare statement!';
				}

		 			//close connection
		 			$stmt->close();
		 			$conn->close();	
		}


		

		

		

?>