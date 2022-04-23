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
	<title>Add Record</title>
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

		<div class="add-form">	
			<form action="addborrow.php" method = "post">
				<h1><b>Add Record</b></h1>
				<p>Member ID:</p>
					<input type="text" name="member_id" size="40"><br><!--link to member database-->
				<p>Book ID:</p>
					<input type="text" name="book_id" size="40"><br>
				<p>Date Borrowed:</p>
					<input type="datetime-local" step="1" name="date_borrow" id="date-borrowed">
				<p>Due Date:</p>
					<input type="date" name="due_date" id="due-date">
				<label for="status"><p>Status:</p></label>
					<select id="status" name="borrow_status">
					 	  <option value="pending">Pending</option>
					      <option value="returned">Returned</option>
					      <option value="overdue">Overdue</option>
					 	</select>

				<a href="borrow.php"><button id="registerButton" type="submit" name = "submit">Add</button></a>
			</form>
	</div>
</body>
</html>
