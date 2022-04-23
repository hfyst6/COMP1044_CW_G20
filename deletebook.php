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
        //create empty variables
        $deleteerr="";
        //if variable exist execute sql
        if(isset($_GET['del'])){ 
            $bkid = $_REQUEST['del']; //capture variable

            $sql = "SELECT * FROM `borrowdetails` WHERE `book_id` = $bkid;";
            $result = $conn->query($sql); //execute sql
            if($result->num_rows > 0){ //if record exist
                $conn->close(); //close connection
                $deleteerr="Delete error."; //fill in variable
                header("Location: 1ndex.php?del=$deleteerr");
            }else{
                $stmt = $conn->prepare("DELETE FROM `book` WHERE `book_id` = ? "); // prepare statement and bind parameters
                $stmt->bind_param("i",$bkid);
    
                $result = $stmt->execute(); //execute sql
                if ( $result === FALSE ) { //if execution fail 
                    die('execute() failed: ' . htmlspecialchars($stmt->error)); //error message
                }else{
                    $stmt->close();
                    $conn->close(); //close statement and connection
                    header("Location: 1ndex.php");
                }
            }
        }
    ?>
</body>
</html>