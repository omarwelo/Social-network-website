					
<?php 
			//used to load all posts when using ajax without clicking submit button
				require 'db_connection.php';
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

						?>