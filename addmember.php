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
        //if variable exist execute sql for adding member
        if(isset($_POST['submit'])){ 
            //prepare statement and bind paramters
            $stmt = $conn->prepare("INSERT INTO member (`member_id`, `firstname`, `lastname`, `gender`, `address`, `contact`, `type_id`, `year_level`, `status`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssiiss", $memberid, $firstname, $latename, $gender, $address, $contact, $typeid, $yearlevel, $status);
            //set parameters and execute
            $memberid=NULL;
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