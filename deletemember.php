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
        //create an empty variable
        $deleteerr="";
        if(isset($_GET['del'])){ //if variable exist
            $memberid = $_REQUEST['del']; //capture variable

            $sql = "SELECT * FROM `borrow` WHERE `member_id` = $memberid;"; 
            $result = $conn->query($sql);// execute sql

            if($result->num_rows > 0){ //if result exist
                $conn->close(); //close connection
                $deleteerr="Delete error."; //fill in variable
                header("Location: members.php?del=$deleteerr"); //pass variable
            }else{
                $stmt = $conn->prepare( "DELETE FROM `member` WHERE member_id = ? ;"); //prepare statement and bind parameter
                $stmt->bind_param("i",$memberid);

                $result = $stmt->execute(); //execute sql
                if ( $result === FALSE ) { //if execution fail
                    die('execute() failed: ' . htmlspecialchars($stmt->error)); //error message
                }else{
                    $stmt->close();
                    $conn->close(); //close statement and connection
                    header("Location: members.php");
                }
            }
            
        }
    ?>
</body>
</html>