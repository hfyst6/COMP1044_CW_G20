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
        //if variable exist execute update operation
        if(isset($_POST['submit'])){ 
            //prepare statement and bind parameters
            $stmt = $conn->prepare("UPDATE `book` SET `book_id` = ?, `book_title` = ?, `category_id` = ?, `author` = ?, 
            `book_copies` = ?, `book_pub` = ?, `isbn` = ?, `copyright_year` = ?, `date_receive` = ?,
            `date_added` = ?, `status` = ? WHERE book_id = ?");
            $stmt->bind_param("isisissssssi", $bookid, $booktitle, $categoryid, $author, $bookcopies, $bookpub, $isbn, $copyrightyear, $dater, $datea, $status, $bookid);

            //set parameters and execute
            $bookid=$_REQUEST['book_id'];
            $booktitle=$_REQUEST['book_title'];
            $categoryid=$_REQUEST['category_id'];
            $author=$_REQUEST['author'];
            $bookcopies=$_REQUEST['book_copies'];
            $bookpub=$_REQUEST['book_pub'];
            $isbn=$_REQUEST['isbn'];
            $copyrightyear=$_REQUEST['copyright_year'];
            $dater=$_REQUEST['date-received'];
            $dater = date("Y-m-d H:i:s", strtotime($dater));
            $datea=$_REQUEST['date-added'];
            $datea = date("Y-m-d H:i:s", strtotime($datea));
            $status=$_REQUEST['status'];
            $stmt->execute();
            
            $stmt->close();
            $conn->close(); //close statement and connection

            header("Location: 1ndex.php");
        }
        
        ?>
</body>
</html>