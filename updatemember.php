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
            //update member details
            $stmt = $conn->prepare("UPDATE `member` SET `member_id` = ?, `firstname` = ?, `lastname` = ?, `gender` = ?, `address` = ?, 
            `contact` = ?, `type_id` = ?, `year_level` = ?, `status` = ? WHERE member_id = ?");
            $stmt->bind_param("issssiissi", $memberid, $firstname, $latename, $gender, $address, $contact, $typeid, $yearlevel, $status, $memberid);

            //set parameters and execute
            $memberid=$_REQUEST['member_id'];
            $firstname=$_REQUEST['firstname'];
            $latename=$_REQUEST['lastname'];
            $gender=$_REQUEST['gender'];
            $address=$_REQUEST['address'];
            $contact=$_REQUEST['contact'];
            $typeid=$_REQUEST['typeID'];
            $yearlevel=$_REQUEST['year-level'];
            $status=$_REQUEST['status'];
            $stmt->execute();

            $stmt->close();
            $conn->close(); //close statement and connection
        }
        header("Location: members.php");

        ?>
</body>
</html>