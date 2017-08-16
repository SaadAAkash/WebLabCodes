<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $servername = "localhost";
        $username = "tishpish";
        $password = "password";
        $dbname = "myDB";

	$conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "CREATE TABLE IF NOT EXISTS 
              Login (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                        username VARCHAR(30) NOT NULL,
                        email VARCHAR(50) NOT NULL
                        )";

        //echo("First name: " . $_POST['name'] . "<br />\n");

        if (empty($_POST["email"]))
        {
            echo "Email is required";
        }
        else
        {
            $email = $_POST["email"];
        }
        if (empty($_POST["name"]))
        {
            $userErr = "UserName is required";
            echo $userErr;
        }
        else
        {
            $uname = $_POST["name"];
        }

        if (!empty($_POST["email"]) && !empty($_POST["name"]) )
        {

           // echo "hello".$uname;

            

            if ($conn->query($sql) === TRUE)
            {
                $sql = "INSERT INTO Login (username, email) VALUES ('$uname', '$email')";

                if ($conn->query($sql) === TRUE)
                {
                    //echo "New record created successfully";

                }
                else
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            else
            {
                echo "Error creating table: " . $conn->error;
            }

           
        }
	 $conn->close();

    }

?>

<html>
<body>

<form action="index.php" method="POST">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit">
</form>


    <?php

    $servername = "localhost";
    $username = "tishpish";
    $password = "password";
    $dbname = "myDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, username, email FROM Login";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<table border=\"1\">";
        while($row = $result->fetch_assoc())
        {
            echo "<tr><td>" . $row["id"]. "</td><td>". $row["username"]. "</td><td>" . "  " . $row["email"]. "</td></tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "0 results";
    }
    $conn->close();
    ?>



</body>
</html>


