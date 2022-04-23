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
	//if variable exist start fetching data from table
	if (isset($_GET["edit"])) {
		$memberid = $_GET['edit']; //capture variable

		$sql = "SELECT * FROM `member` WHERE member_id=$memberid;";
		$result = $conn->query($sql); //execute sql

		$n = $result -> fetch_array();

		$memberid=$n['member_id'];
        $firstname=$n['firstname'];
        $lastname=$n['lastname'];
        $gender=$n['gender'];
        $address=$n['address'];
        $contact=$n['contact'];
        $typeid=$n['type_id'];
        $yearlevel=$n['year_level'];
        $status=$n['status']; //fetch all data
	}
	$conn->close(); //close connection
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Members</title>
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

		<div class="add-form">
			<form action = "updatemember.php" method = post>
				<h1><b>Update Member</b></h1>
				<p>Member ID:</p>
					<input type="text" name="member_id" value = "<?php echo $memberid; ?>" size="40"><br>
				<p>First Name:</p>
					<input type="text" name="firstname" value = "<?php echo $firstname; ?>" size="40"><br>
				<p>Last Name:</p>
					<input type="text" name="lastname" value = "<?php echo $lastname; ?>" size="40"><br>
				<label for="gender"><p>Gender:</p></label>
					<select id="gender" name="gender">
					 	<option value="Male" <?= ($gender == "Male")? "selected" : ""?>>Male</option>
					    <option value="Female" <?= ($gender == "Female")? "selected" : ""?>>Female</option>
					 </select>
				<p>Address:</p>
					<input type="text" name="address" value = "<?php echo $address; ?>" size="40"><br>
				<p>Contact:</p>
					<input type="text" name="contact" value = "<?php echo $contact; ?>" size="40"><br>
				<label for="T.ID"><p>Type:</p></label>
					<select id="T.ID" name="typeID">
					 	<option value="2" <?= ($typeid == "2")? "selected" : ""?>>Teacher</option>
					    <option value="20" <?= ($typeid == "20")? "selected" : ""?>>Employee</option>
					    <option value="21" <?= ($typeid == "21")? "selected" : ""?>>Non-teaching</option>
					    <option value="22" <?= ($typeid == "22")? "selected" : ""?>>Student</option>
					    <option value="32" <?= ($typeid == "32")? "selected" : ""?>>Construction</option>
					</select><br>

				<label for="year-level"><p>Year Level:</p></label>
					<select id="year-level" name="year-level">
					 	<option value="Faculty" <?= ($yearlevel == "Faculty")? "selected" : ""?>>Faculty</option>
						<option value="First Year" <?= ($yearlevel == "First Year")? "selected" : ""?>>First Year</option>
					    <option value="Second Year" <?= ($yearlevel == "Second Year")? "selected" : ""?>>Second Year</option>
						<option value="Third Year" <?= ($yearlevel == "Third Year")? "selected" : ""?>>Third Year</option>
					    <option value="Fourth Year" <?= ($yearlevel == "Fourth Year")? "selected" : ""?>>Fourth Year</option>

					</select><br>

				<label for="status"><p>Status:</p></label>
					<select id="status" name="status">
					 	<option value="Active" <?= ($status == "Active")? "selected" : ""?>>Active</option>
					    <option value="Banned" <?= ($status == "Banned")? "selected" : ""?>>Banned</option>
					</select><br>
				<a href="members.php"><button id="registerButton" type="submit" name="submit">Update</button></a>
			</form>
	</div>
</body>
</html>
