<?php

    
        $servername = "localhost"; 
        $username = "root";   //username of phpmyadmin is by default is root
        $password = "akash05";  // the pass given during the installation of phpmyadmin

        $dbname = "database1";  //change the dbname from phpmyadmin

		//setting up the connections 

	//alternate way:
	//$conn = new mysqli_connect($servername, $username, $password, $dbname);
	$conn = new mysqli($servername, $username, $password, $dbname);


	$uname = $_POST['usr'];
	$pass = $_POST['pwd'];  //not password, that var $password is already assigned
	$email = $_POST['ema'];

	//alternate way:
    	//if ($conn->connect_errno > 0)
		//die("Connection failed: " . $conn->connect_error);
	
           
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	echo "Running....";
	//if shown, then run hocche for sure	

	if(isset($_POST['loginbut']))  //if login button is pressed
	{
		if(empty($uname))
		{
			echo  "<br>" . "User name not entered. Please fill up your user name.";
			die();
		}
		if(empty($pass))
		{
			echo  "<br>" . "User password not entered. Please select a password for you.";
			die();
		}
		if(empty($email))
		{
			echo  "<br>" . "Email not entered. Please fill up your email id.";
			die();
		}

		//print in a table:

			//echo "<table border=\"1\">";
			//echo "<tr><td>" . $row["Name"]. "</td><td>". $row["Password"]. "</td><td>" . "  " . $row["Email"]. "</td></tr>";
        	
	
		echo  "<br>". " <b>User name: </b>".$uname . " <b>Password: </b>" . $pass . " <b>Email ID: </b>".$email;
		
		$sql = "INSERT INTO logintablefinal2 (Name, Password, Email) VALUES ('$uname' , '$pass', '$email')";

		if($conn->query($sql) === TRUE)
		{
			
			echo  "<br>" . "New record added successfully. Your credentials are registered into the database. Thank you.";
		}
		else
		{
			echo  "<br>" . "Error adding the record! Oops! Error :" .$sql . "<br>" . $conn->error;
		}
	}
	if(isset($_POST['checkbut']))  //if see all button is pressed
	{
		echo  "<br>" . "The users who logged in....";

		$sql = "SELECT * FROM logintablefinal2";  //table name change

		$result = $conn->query($sql);  //execute the query

		if($result->num_rows === 0)
		{
			echo "<br>" . "None logged in yet!";
			die();
		}
		echo "<table border=\"1\">";
		while($row = $result->fetch_assoc())   //fetch associated
		{
			echo "<tr><td>" . $row["Name"]. "</td><td>". $row["Password"]. "</td><td>" . "  " . $row["Email"]. "</td></tr>";
        				
			//echo "<br>" . "<b>User name: </b>" . $row["Name"] . " <b>Password: </b>" . $row["Password"]. " <b>Email: </b>" . $row["Email"];
		}
	}
	$conn->close();
?>
