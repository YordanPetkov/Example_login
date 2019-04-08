<?php
	
	echo "Registration";
	
?>

	<form method="post">
	name<input type = "text" name = "user" required>
	<?php echo "<br>";?>
	pass <input type = "password" name = "pass" required>
	<?php echo "<br>";?>
	confirm pass <input type = "password" name = "confpass" required>
	<?php echo "<br>";?>
	<input type = "submit" value = "register" >
	</form>
	
	<?php
				if(isset($_POST["user"]) && (isset($_POST["pass"])))
				{
					$name = $_POST["user"];
					$pass = $_POST["pass"];
					$confpass = $_POST["confpass"];
					if($pass != $confpass)
					{
						echo "<p><strong>Passwords are different</strong></p> <br>";
					}
					else if(!preg_match("/^[a-zA-Z0-9]*$/",$name) || (!preg_match("/^[a-zA-Z0-9]*$/",$pass)))
					{
						echo "<p><strong>Invalid username or password</strong></p> <br>";
						echo "Only letters and numbers allowed!";
					}
					else if(strlen($pass) < 6 || strlen($name) < 6)
					{
						echo "Minimum 6 characters !";
					}
					else 
					{
						$link =new mysqli("localhost" , "exlogin" , "123456" ,"users" );
						
						if($link === false)
						{
							die("ERROR: Could not connect. " . mysql_connect_error());
						}
						
						$pass = password_hash($_POST["pass"],PASSWORD_DEFAULT);
						$query =
						        "
									INSERT INTO members
									VALUES ('$name','$pass')
								";
						if(mysqli_query($link, $query)){

							//echo "Records inserted successfully.";

						} else{

							echo "ERROR: Could not able to execute $query. " . mysqli_error($link);

						}
						
						
						
						$link -> close();
						header('Location: /example_login');
					}
					
					
					 
				}
				