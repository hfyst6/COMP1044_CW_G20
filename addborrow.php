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
       
        //if variable exist then execute sql for adding borrow record
        if(isset($_POST['submit'])){
            //prepare statement and bind parameters
            $stmt = $conn->prepare("INSERT INTO `borrow` (`borrow_id`, `member_id`, `date_borrow`, `due_date`) VALUE ( ?, ?, ?, ?) ");
            $stmt->bind_param("iiss", $borrowid, $memberid, $dateborrow, $duedate);
            //set parameters and execute
            $borrowid=NULL;
            $memberid=$_REQUEST['member_id'];
            $dateborrow=$_REQUEST['date_borrow'];
            $duedate=$_REQUEST['due_date'];
            $stmt->execute();

            $last_id = $stmt->insert_id; //capture the new id

            $stmt->close();//close statement
            //prepare statement and bind parameters
            $stmt = $conn->prepare("INSERT INTO `borrowdetails` (`book_id`,`borrow_id`, `borrow_status`, `date_return`) VALUE ( ?, ?, ?, ? )");
            $stmt->bind_param("iiss", $bookid, $last_id, $borrowstatus, $datereturn);
            //set parameters and execute
            $bookid=$_REQUEST['book_id'];
            $borrowstatus=$_REQUEST['borrow_status'];
            $datereturn='0000-00-00 00:00:00';
            $stmt->execute();
            
            $stmt->close();
            $conn->close(); //close statement and connection
            header("Location: borrow.php");
        }   

        ?>
</body>
</html>