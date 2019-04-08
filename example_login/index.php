<?php
	
	echo "You are not logged in!";
	
?>
	
			<form method="post">
			name<input type = "text" name = "user" required>
			<?php echo "<br>";?>
			pass <input type = "password" name = "pass" required>
			<input type = "submit" value = "login">
			
			</form>
			
			<form action = "create.php">
			<input type = "submit" value = "create account">
			</form>
			<?php
				if(isset($_POST["user"]) && (isset($_POST["pass"])))
				{
					$name = $_POST["user"];
					$pass = $_POST["pass"];
					if(!preg_match("/^[a-zA-Z0-9]*$/",$name) || (!preg_match("/^[a-zA-Z0-9]*$/",$pass)))
					{
						echo "<p><strong>Invalid username or password</strong></p> <br>";
						echo "Only letters and numbers allowed!";
					}
				
					else
					{
						$link =new mysqli("localhost" , "exlogin" , "123456" , "users");
						
						if($link === false)
						{
							die("ERROR: Could not connect. " . mysql_connect_error());
						}
						
						$query = "select * from members";
						$result = $link -> query($query);
						//echo empty($result);
						
						 
						if(!empty($result))
						{
							while($row = mysqli_fetch_row($result))
							{
								
								if($row[0] == $name && password_verify($pass,$row[1]))
								{
									header('Location: /example_login/example_page.php');
									echo "You are logged in!";
								}
								else
								{
									echo "Incorrect name or password!";
									die();
								}
								
							}
						}
						else
						{
							echo "You can't logged in!";
							die();
						}
						$link -> close();
					}
				}
				
				
			?>
			
			
			

