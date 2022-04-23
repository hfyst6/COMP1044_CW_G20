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
        //if variable exist start update operation
        if(isset($_POST['submit'])){ 
            $borrowid=$_REQUEST['borrow_id'];
            $bookid=$_REQUEST['book_id'];
            $borrowstatus=$_REQUEST['borrow_status'];
            $datereturn=$_REQUEST['date_return'];
            $datereturn = date("Y-m-d H:i:s", strtotime($datereturn)); //capture all inputs

            $sql="UPDATE `borrowdetails` SET book_id = $bookid, borrow_id = $borrowid, borrow_status = '$borrowstatus', date_return = '$datereturn' WHERE borrow_id = $borrowid;";

            if($conn->query($sql) === TRUE){ //if execution succeed
                $stmt = $conn->prepare("UPDATE `borrow` SET borrow_id = ?, member_id = ?, date_borrow = ?, due_date = ? WHERE borrow_id = ?;");
                $stmt ->bind_param("iissi", $borrowid, $memberid, $dateborrow, $duedate, $borrowid); //prepare statement and bind parameters
                //set parameters and execute
                $memberid=$_REQUEST['member_id'];
                $dateborrow=$_REQUEST['date_borrow'];
                $dateborrow = date("Y-m-d H:i:s", strtotime($dateborrow));
                $duedate=$_REQUEST['due_date'];
                $stmt->execute();
                $stmt->close(); 
            }
            $conn->close(); //close connection
        }
        header("Location: borrow.php");

        ?>
</body>
</html>