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

		$sql = "SELECT * FROM `borrowdetails`, `borrow` WHERE borrowdetails.borrow_id=borrow.borrow_id;";
        $result = $conn->query($sql); //execute sql
		$conn->close(); //close connection
?>

<!DOCTYPE html>
<html>
<head>
	<title>Borrow Records</title>
	<link rel="stylesheet" type="text/css" href="style.css?<?=filemtime("style.css")?>">
	<script src="https://kit.fontawesome.com/c272342684.js" crossorigin="anonymous"></script>

	<script language="javascript">
	function alert(url) {
		if (confirm("Are you sure you wish to log out?")) {	//prompt user to confirm log out
			window.location.href = url;
			return true;
		} else {
			return false;
		}
	}
	function confirmDel(url) {
		if (confirm("Are you sure you wish to delete the record?")) {
			window.location.href = url;
			return true;
		} else {
			return false;
		}
	}
	function confirmEdit(url) {
		if (confirm("Are you sure you wish to update the record data?")) {
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
				<li ><a href="1ndex.php"><i class="fa-solid fa-book"></i>Library</a></li>
			<li><a href="members.php"><i class="fa-solid fa-people-group"></i>Members</a></li>
			<li style="border-bottom: 2px solid #616161;"><a href="borrow.php"><i class="fa-solid fa-clipboard"></i><strong>Borrow Records</strong></a></li>
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
	<table class="table">
     <thead>
     	<tr>
     	 <th>Borrow Id</th>
		 <th>Book Id</th>
     	 <th>Member ID</th>
     	 <th>Date Borrowed</th>
     	 <th>Due Date</th>
     	 <th>Status</th>
     	 <th>Date Returned</th>
     	</tr>
     </thead>
     <tbody>
	 	<?php 
			while($row = $result->fetch_assoc()) {
		?>
     	  <tr>
     	  	  <td data-label="Borrow.ID"><?php echo $row["borrow_id"];?></td>
     	  	  <td data-label="Book.ID"><?php echo $row["book_id"];?></td>
     	  	  <td data-label="M.ID"><?php echo $row["member_id"];?></td>
     	  	  <td data-label="date-borrow"><?php echo $row["date_borrow"];?></td>
     	  	  <td data-label="due-date"><?php echo $row["due_date"];?></td>
     	  	  <td data-label="status"><?php echo $row["borrow_status"];?></td>
     	  	  <td data-label="date-returned"><?php echo $row["date_return"];?></td>
     	  
     	  	  <div class="edit">
     	  	  	<td>
     	  	  		<a href="updaterecords.php?edit=<?php echo $row["borrow_id"]; ?>" onclick="return confirmEdit(this.href)">
     	  	  			<i class="fa-solid fa-pen-to-square" style="padding-right: 10px;"></i>
     	  	  		</a>
     	  	  		<a href="deleteborrow.php?del=<?php echo $row["borrow_id"]; ?>"  onclick="return confirmDel(this.href)">
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
	<a href="AddRecords.php"><button type="button" class="button">
		<span class="addBook-icon"><i class="fa-solid fa-file-circle-plus"></i>
		</span>
		<span class="addBook">Add Records</span>
	</button></a>
</div>
</body>
</html>