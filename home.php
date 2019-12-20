
 <?php 

 	 session_start();
 	 session_regenerate_id(); //to prevent session fixation
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

		<style>
			
	
		</style>
		
	</head>
	<body onload="return share()">
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
						<?php
						$sessionk=$_SESSION['username'];
								$sql ="SELECT * FROM users WHERE `users`.`username` = '$sessionk' ";
									$query=mysqli_query($conn,$sql);
									$num_of_rows=mysqli_affected_rows($conn);
									
										$row=mysqli_fetch_assoc($query);
								echo "<img src=".$row['picture']." alt='profile picture' title='profile picture' />
							<h3>". $_SESSION['username'] ."</h3>
							<p>".$row['job']."</p>
						</div>
						<div class='age'>
							
										<h3>age</h3>
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
				<main >
					<section class="first_section">
						<form action="" method="get" id="firstform">
							<textarea id="aj" name="post" placeholder="What's on your mind?"></textarea>
							<input type="button" name="share" value="post"
							 onclick=" return comment()"/>
						</form>
					</section>

					<article id="main">
						
					</article>
				

					
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
						<div  class="chat_header">
							<h3>chat</h3>
						</div>
						<div id="chat_body" class="chat_body">message</div>
						<div class="chat_messages">
							<form action="" method="get" id="secondform">
								<textarea id="message" name="message"></textarea>
								<input type="button"  name="send" value="send" onclick="return chat()"/>
							</form>
						</div>
					</section>

				</aside>
			</div>
		</div>

			<script src="js/all.js" ></script>						<!--fontawesome js file -->
			<script src="js/jquery.js"></script>
			<script>
				
				
				function chat() {
				  
				  
				  var message= document.getElementById("message").value ;
				  
				  
				  var xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    document.getElementById("chat_body").innerHTML = this.responseText;
				    }
				  };
				 xhttp.open("GET", "chat.php?message="+message+"&send=send", true);
				  xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
				  xhttp.send(); 
				  document.getElementById('secondform').reset();
				}


				function comment() {
				  
				  
				  var post= document.getElementById("aj").value ;
				  
				  
				  var xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    document.getElementById("main").innerHTML = this.responseText;
				    }
				  };
				 xhttp.open("GET", "chat.php?post="+post+"&share=send", true);
				  xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
				  xhttp.send(); 
				  document.getElementById('firstform').reset();
				}


				$(document).ready(function(e) {

					$.ajaxSetup({cache:false});
					setInterval( function() { $('#main').load('logs.php'); }, 500);
				});
			</script>
	</body>
</html>

