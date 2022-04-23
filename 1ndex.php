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
	//create an empty variable for error handling
	$deleteerr="";
	//capture del if del is passed over to here
	if(isset($_GET['del'])){
		$deleteerr=$_GET['del'];
	}
	//sql to select all from book list
	$sql = "SELECT * FROM `book`";
    $result = $conn->query($sql);
	//close connection
	$conn->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="style.css?<?=filemtime("style.css")?>">
	<script src="https://kit.fontawesome.com/c272342684.js" crossorigin="anonymous"></script>

	<script language="javascript">
	function alert(url) {
		if (confirm("Are you sure you wish to log out?")) {
			window.location.href = url;
			return true;
		} else {
			return false;
		}
	}
	function confirmDel(url) {
		if (confirm("Are you sure you wish to delete the book?")) {
			window.location.href = url;
			return true;
		} else {
			return false;
		}
	}
	function confirmEdit(url) {
		if (confirm("Are you sure you wish to update the data of book?")) {
			window.location.href = url;
			return true;
		} else {
			return false;
		}
	}
	</script>
</head>
<body>
	<div class="sidebar">
		<ul>
				<li style="border-bottom: 2px solid #616161;"><a href="#"><i class="fa-solid fa-book"></i><strong>Library</strong></a></li>
			<li><a href="members.php"><i class="fa-solid fa-people-group"></i>Members</a></li>
			<li><a href="borrow.php"><i class="fa-solid fa-clipboard"></i>Borrow Records</a></li>
			<div>
				<li class="search-icon">
					<a href="search.php">
						<button><i class="fas fa-search"></i>Search</button>
					</a>
				</li>
			</div>
			<li><a href="close.php" onclick="return alert(this.href)"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a></li>
		</ul>
	</div>
	<p style ="margin-left : 150px; margin-top : 10px">
		<?php
			if(!empty($deleteerr)){
				echo'<span style="color : red">Book cannot be deleted as there exists its borrow records.</span>';
			} 
		?>
	</p>
	
	<table class="table">
     <thead>
     	<tr>
     	 <th>Book Id</th>
     	 <th>Title</th>
     	 <th>Category ID</th>
     	 <th>Author</th>
     	 <th>Copies</th>
     	 <th>Pub</th>
     	 <th>ISBN</th>
     	 <th>Copyright Year</th>
     	 <th>Date Received</th>
     	 <th>Date Added</th>
     	 <th>Status</th>
     	</tr>
     </thead>
     <tbody>
		<?php 
		while($row = $result->fetch_assoc()) {
		?>
     	  <tr>
     	  	  <td data-label="B.ID"><?php echo $row["book_id"];?></td>
     	  	  <td data-label="title"><?php echo $row["book_title"];?></td>
     	  	  <td data-label="C.ID"><?php echo $row["category_id"];?></td>
     	  	  <td data-label="author"><?php echo $row["author"];?></td>
     	  	  <td data-label="copies"><?php echo $row["book_copies"];?></td>
     	  	  <td data-label="pub"><?php echo $row["book_pub"];?></td>
     	  	  <td data-label="isbn"><?php echo $row["isbn"];?></td>
     	  	  <td data-label="copy-year"><?php echo $row["copyright_year"];?></td>
     	  	  <td data-label="date-received"><?php echo $row["date_receive"];?></td>
     	  	  <td data-label="date-added"><?php echo $row["date_added"];?></td>
     	  	  <td data-label="status"><?php echo $row["status"];?></td>
     	  	  <div class="edit">
     	  	  	<td>
     	  	  		<a href="updateBooks.php?edit=<?php echo $row["book_id"]; ?>" onclick="return confirmEdit(this.href)">
     	  	  			<i class="fa-solid fa-pen-to-square" style="padding-right: 10px;"></i>
     	  	  		</a>
     	  	  		<a href="deletebook.php?del=<?php echo $row["book_id"]; ?>" onclick="return confirmDel(this.href)">
     	  	  			<i class="fa-solid fa-trash-can"></i></td>
     	  	  		</a>
     	  	  </div>    	  	  
     	  </tr>
		   <?php
                }
            ?>
     </tbody>
   </table>
	
<div class="addButton">
	<a href="addBooks.php">
	<button type="button" class="button">
		<span class="addBook-icon"><i class="fa-solid fa-file-circle-plus"></i>
		</span>
		<span class="addBook">Add Books</span>
	</button>
	</a>
</div>
</body>
</html>