<?php
	// session will start if only user has login
	session_start();
	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		header("location: auth.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Members</title>
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
			<form action = "addmember.php" method = post>
				<h1><b>Add Member</b></h1>
				<p>First Name:</p>
					<input type="text" name="firstname" size="40"><br>
				<p>Last Name:</p>
					<input type="text" name="lastname" size="40"><br>
				<label for="gender"><p>Gender:</p></label>
					<select id="gender" name="gender">
					 	<option value="Male">Male</option>
					    <option value="Female">Female</option>
					 </select>
				<p>Address:</p>
					<input type="text" name="address" size="40"><br>
				<p>Contact:</p>
					<input type="text" name="contact" size="40"><br>
				<label for="T.ID"><p>Type:</p></label>
					<select id="T.ID" name="typeID">
					 	<option value="2">Teacher</option>
					    <option value="20">Employee</option>
					    <option value="21">Non-teaching</option>
					    <option value="22">Student</option>
					    <option value="32">Construction</option>
					</select><br>

				<label for="year-level"><p>Year Level:</p></label>
					<select id="year-level" name="year-level">
					 	<option value="Faculty">Faculty</option>
						<option value="First Year">First Year</option>
					    <option value="Second Year">Second Year</option>
						<option value="Third Year">Third Year</option>
					    <option value="Fourth Year">Fourth Year</option>
					</select><br>

				<label for="status"><p>Status:</p></label>
					<select id="status" name="status">
					 	<option value="Active">Active</option>
					    <option value="Banned">Banned</option>
					</select><br>
				<a href="members.php"><button id="registerButton" type="submit" name="submit">Add</button></a>
			</form>
	</div>
</body>
</html>
