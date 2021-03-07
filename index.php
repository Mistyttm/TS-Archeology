<!DOCTYPE html>
<?php
	session_start();
?>
<html>
	<head>
		<title>Database Example</title>
		<link href="external/format.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<p><a href='insert.php'>Sign up</a></p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<label>User ID:</label>
			<br>
			<input type="text" name="user">
			<br>
			<label>Password:</label>
			<br>
			<input type="password" name="pword">
			<br>
			<br>
			<input type="submit" value="Login">
		</form>
		<p>
			<?php
				//database cofig file
				include 'config.php';
				// Create connection
				$conn = mysqli_connect( $servername, $username, $password, $dbname );

				// Check connection
				if ( !$conn ) {
					die( "Connection failed: " . mysqli_connect_error() );
				}

				if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
					$_SESSION[ 'id' ] = $_POST[ "user" ];
					$_SESSION[ 'pass' ] = md5( $_POST[ "pword" ] );

					$sql = "SELECT Password FROM users WHERE User_ID = '" . $_SESSION[ 'id' ] . "' ";

					$result = mysqli_query( $conn, $sql );

					if ( mysqli_num_rows( $result ) > 0 ) {
						$row = mysqli_fetch_assoc( $result );
						if ( $row[ "Password" ] == $_SESSION[ 'pass' ] ) {
							echo "login successful </p><p><a href='displaytable.php'><input type='submit' value='Display Users'></a></p>";
						} else {
							echo "login failed</p>";
						}
					} else {
						echo "No user found</p>";
					}

					mysqli_close( $conn );
				}
			?>
		</p>
	</body>
</html>
