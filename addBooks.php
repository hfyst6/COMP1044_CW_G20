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
	<title>Add Book</title>
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
				<li style="border-bottom: 2px solid #616161;"><a href="1ndex.php"><i class="fa-solid fa-book"></i><strong>Library</strong></a></li>
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

		<div class="add-form">
			
			<form action = "addbook.php" method = "post">
				<h1><b>Add Book</b></h1>
				<p>Book Title:</p>
				<input type="text" name="title" size="40"><br>
				<label for="C.ID"><p>Category:</p></label>
					<select id="C.ID" name="category_id">
					 		<option value="1">1-Periodical</option>
					      <option value="2">2-English</option>
					      <option value="3">3-Math</option>
					      <option value="4">4-Science</option>
					      <option value="5">5-Encyclopedia</option>
					      <option value="6">6-Filipiniana</option>
					      <option value="7">7-Newspaper</option>
					      <option value="8">8-General</option>
					      <option value="9">9-References</option>
				
					 	</select>
				<p>Author:</p>
				<input type="text" name="author" size="40"><br>
				<p>Copies:</p>
				<input type="text" name="book_copies" size="40"><br>
				<p>Pub:</p>
				<input type="text" name="book_pub" size="40"><br>
				<p>ISBN:</p>
				<input type="text" name="isbn" size="40"><br>
				<p>Copyright Year:</p>
				<input type="text" name="copyright_year" size="40"><br>


					<p>Date Received:</p>
					<input type="datetime-local" step="1" name="date-received"size="40">
					<p>Date Added:</p>
					<input type="datetime-local" step="1" name="date-added"size="40">

					<label for="status"><p>Status:</p></label>
					<select id="status" name="status">
					 		<option value="New">New</option>
					      <option value="Old">Old</option>
					      <option value="Damaged">Damaged</option>
					      <option value="Archive">Archive</option>
					      <option value="Lost">Lost</option>
					 	</select>
			
			
					<br>

				<a href="1ndex.php"><button id="registerButton" type="submit" name ="submit">Add</button></a>
			</form>
	</div>
</body>
</html>
