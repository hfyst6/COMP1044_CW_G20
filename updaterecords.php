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
		$borrowid = $_GET['edit']; //capture variable

		$sql = "SELECT * FROM `borrowdetails`, `borrow` WHERE borrowdetails.borrow_id=borrow.borrow_id AND borrow.borrow_id=$borrowid;";
		$result = $conn->query($sql); //execute sql

		$n = $result -> fetch_array();

		$borrowid=$n['borrow_id'];
        $bookid=$n['book_id'];
        $memberid=$n['member_id'];
        $borrowstatus=$n['borrow_status'];
		$dateborrow = date("Y-m-d\TH:i:s", strtotime($n['date_borrow']));
		$datereturn = date("Y-m-d\TH:i:s", strtotime($n['date_return']));
        $duedate= date("Y-m-d", strtotime($n['due_date'])); //fetch all the data
	}
	$conn->close();//close connection
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Record</title>
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
			<form action="updateborrow.php" method = "post">
				<h1><b>Update Record</b></h1>
				<p>Borrow ID:</p>
					<input type="text" name="borrow_id" value = "<?php echo $borrowid; ?>" size="40"><br>
				<p>Member ID:</p>
					<input type="text" name="member_id" value = "<?php echo $memberid; ?>" size="40"><br><!--link to member database-->
				<p>Book ID:</p>
					<input type="text" name="book_id" value = "<?php echo $bookid; ?>" size="40"><br>
				<p>Date Borrowed:</p>
					<input type="datetime-local" step="1" value = "<?php echo $dateborrow; ?>" name="date_borrow" id="date-borrowed">
				<p>Due Date:</p>
					<input type="date" value = "<?php echo $duedate; ?>" name="due_date" id="due-date">
				<p>Date Returned:</p>
					<input type="datetime-local" step="1" value = "<?php echo $datereturn; ?>" name="date_return" id="date-borrowed">
				<label for="status"><p>Status:</p></label>
					<select id="status" name="borrow_status">
					 	  <option value="pending" <?= ($borrowstatus == "pending")? "selected" : ""?>>Pending</option>
					      <option value="returned"<?= ($borrowstatus == "returned")? "selected" : ""?> >Returned</option>
					      <option value="overdue" <?= ($borrowstatus == "overdue")? "selected" : ""?>>Overdue</option>
					 	</select>

				<a href="borrow.php"><button id="registerButton" type="submit" name = "submit">Update</button></a>
			</form>
	</div>
</body>
</html>
