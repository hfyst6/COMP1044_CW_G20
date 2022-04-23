<html>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		// session will start if only user has login
		session_start();
		if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
			header("location: auth.php");
			exit;
		}
        //if variable exist execute deletion operation
        if(isset($_GET['del'])){
            $borrowid = $_GET['del']; //capture variable
            //prepare statement and bind parameters
            $stmt = $conn->prepare("DELETE FROM `borrowdetails` WHERE borrow_id =? ; ");
            $stmt->bind_param("i", $borrowid);
            if($stmt->execute()){ //if execution succeed
                $stmt->close(); //close statement
                $stmt =  $conn->prepare("DELETE FROM `borrow` WHERE borrow_id =? ; "); //prepare statement and bind parameters
                $stmt->bind_param("i", $borrowid);

                if($stmt->execute()){ //if execution succeed
                    $stmt->close();
                    $conn->close(); //close statement and connection
                    header("Location: borrow.php");
                }
            }            
        }
    ?>
</body>
</html>