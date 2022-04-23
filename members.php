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
	if(isset($_GET['del'])){ //if variable exist
		$deleteerr=$_GET['del']; //capture variable
	}

	$sql = "SELECT * FROM `member`";
    $result = $conn->query($sql); //execute sql
	$conn->close(); //close connection
?>
<!DOCTYPE html>
<html>
<head>
	<title>Members</title>
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
		if (confirm("Are you sure you wish to delete the member?")) {
			window.location.href = url;
			return true;
		} else {
			return false;
		}
	}
	function confirmEdit(url) {
		if (confirm("Are you sure you wish to update data of the member?")) {
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
				<li><a href="1ndex.php"><i class="fa-solid fa-book"></i>Library</a></li>
			<li style="border-bottom: 2px solid #616161;"><a href="members.php"><i class="fa-solid fa-people-group"></i><strong>Members</strong></a></li>
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
	<p style="margin-left : 150px; margin-top : 10px">
		<?php
			if(!empty($deleteerr)){
				echo'<span style="color : red">Member cannot be deleted as there exists its borrow records.</span>';
			}
		?>
	</p>
	<table class="table">
     <thead>
     	<tr>
     	 <th>Member Id</th>
     	 <th>First Name</th>
     	 <th>Last Name</th>
     	 <th>Gender</th>
     	 <th>Address</th>
     	 <th>Contact</th>
     	 <th>Type ID</th>
     	 <th>Year Level</th>
     	 <th>Status</th>
     	</tr>
     </thead>
     <tbody>
	 	<?php 
			while($row = $result->fetch_assoc()) {
		?>
     	  <tr>
     	  	  <td data-label="M.ID"><?php echo $row["member_id"];?></td>
     	  	  <td data-label="firstname"><?php echo $row["firstname"];?></td>
     	  	  <td data-label="lastname"><?php echo $row["lastname"];?></td>
     	  	  <td data-label="gender"><?php echo $row["gender"];?></td>
     	  	  <td data-label="address"><?php echo $row["address"];?></td>
     	  	  <td data-label="contact"><?php echo $row["contact"];?></td>
     	  	  <td data-label="T.ID"><?php echo $row["type_id"];?></td>
     	  	  <td data-label="year-level"><?php echo $row["year_level"];?></td>
     	  	  <td data-label="status"><?php echo $row["status"];?></td>

     	  	  <div class="edit">
     	  	  	<td>
     	  	  		<a href="updateMembers.php?edit=<?php echo $row["member_id"]; ?>" onclick="return confirmEdit(this.href)">
     	  	  			<i class="fa-solid fa-pen-to-square" style="padding-right: 10px;"></i>
     	  	  		</a>
     	  	  		<a href="deletemember.php?del=<?php echo $row["member_id"]; ?>" onclick="return confirmDel(this.href)">
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
	<a href="addMembers.php"><button type="button" class="button">
		<span class="addBook-icon"><i class="fa-solid fa-file-circle-plus"></i>
		</span>
		<span class="addBook">Add Members</span>
	</button></a>
</div>
</body>
</html>