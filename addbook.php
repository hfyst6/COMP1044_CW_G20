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
        //if variable exist execute sql for adding book
        if(isset($_REQUEST['submit'])){ 
            //prepare insert statement
            $stmt = $conn->prepare("INSERT INTO `book` (`book_id`, `book_title`, `category_id`, `author`, `book_copies`, `book_pub`, `isbn`, `copyright_year`, `date_receive`, `date_added`, `status`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            //bind parameters
            $stmt->bind_param("isisissssss", $bookid, $booktitle, $categoryid, $author, $bookcopies, $bookpub, $isbn, $copyrightyear, $dater, $datea, $status);
            //set parameters and execute
            $bookid=NULL;
            $booktitle=$_REQUEST['title'];
            $categoryid=$_REQUEST['category_id'];
            $author=$_REQUEST['author'];
            $bookcopies=$_REQUEST['book_copies'];
            $bookpub=$_REQUEST['book_pub'];
            $isbn=$_REQUEST['isbn'];
            $copyrightyear=$_REQUEST['copyright_year'];
            $dater=$_REQUEST['date-received'];
            $dater=date("Y-m-d H:i:s", strtotime($dater));
            $datea=$_REQUEST['date-added'];
            $datea = date("Y-m-d H:i:s", strtotime($datea));
            $status=$_REQUEST['status'];
            $stmt->execute();
        
            $stmt->close();
            $conn->close(); //close statement and connection

            header("Location: 1ndex.php");
            exit;
        }
    ?>
</body>
</html>