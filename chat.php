<?php 

require 'db_connection.php';

session_start();
session_regenerate_id(); //to prevent session fixation


				// validation function
				function test_input ($data){

				$data=trim($data);
				$data=strip_tags($data);
				$data=htmlspecialchars($data);
				return $data;

				}
									/*-------post with ajax-------- */
		if (isset($_GET['share'])){

				// validation function
				

				if (!empty($_GET['post'])){
					$user_post=test_input($_GET['post']);
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
		 			
		 ////////////////////////////////////////////////////////////////////////////

		 			$sql ="SELECT * FROM posts";
						$query=mysqli_query($conn,$sql);
						$num_of_rows=mysqli_affected_rows($conn);
						
						for ($i=0;$i<$num_of_rows;$i++)
						{
							$row=mysqli_fetch_assoc($query);

							echo "

							<section>
								<div class='post'>
									<div class='time_post'>
										<img src='images/download.png' alt='profile photo' title='profile photo' />
										<p class='editp'>".$row['username']."</p>
										<p class='edittime'>".$row['post_time']."</p>
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

		}	












									/*-------chat with ajax-------- */
		if (isset($_GET['send'])){



				if (!empty($_GET['message'])){
					$user_message=test_input($_GET['message']);
				}
						
				$date=date(" h:i:s A");

				

				$sql="INSERT INTO chat (message ,message_date,username) 
	 		 	VALUES (? ,?,?)";

	 			if($stmt = $conn->prepare($sql)){

		 			$stmt->bind_param('sss',$user_message,$date,$_SESSION['username']);
		 			

		 			$stmt->execute();
					
					
				} else {
						// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
						echo 'Could not prepare statement!';
				}

		 			//close connection
		 			$stmt->close();


		 								//ORDER BY message_date

		 			$q ="SELECT * FROM chat ";
								$query=mysqli_query($conn,$q);
								$num_of_rows=mysqli_affected_rows($conn);
									
								
								for ($i=0;$i<$num_of_rows;$i++){
									$row=mysqli_fetch_assoc($query);
					echo "<P><span >".$_SESSION['username'].":</span>".$row['message']."<p style='text-align:right;font-size:16px;color:#000'>".$row['message_date']."</p></p>";

								}

		}
		 			
		$conn->close();

?>