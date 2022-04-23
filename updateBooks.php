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
		$bookid = $_GET['edit']; //capture variable

		$sql = "SELECT * FROM `book` WHERE book_id=$bookid;";
		$result = $conn->query($sql); //execute sql

		$n = $result -> fetch_array(); 

		$bookid=$n['book_id'];
        $booktitle=$n['book_title'];
        $categoryid=$n['category_id'];
        $author=$n['author'];
        $bookcopies=$n['book_copies'];
        $bookpub=$n['book_pub'];
        $isbn=$n['isbn'];
        $copyrightyear=$n['copyright_year'];
		$dater = date("Y-m-d\TH:i:s", strtotime($n['date_receive']));
		$datea = date("Y-m-d\TH:i:s", strtotime($n['date_added']));
        $status=$n['status']; //fetch all the data
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Book</title>
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
			
			<form action = "updatebk.php" method = "post">
				<h1><b>Update Book</b></h1>
				<p>Book ID:</p>
				<input type="text" name="book_id" value = "<?php echo $bookid; ?>" size="40"><br>
				<p>Book Title:</p>
				<input type="text" name="book_title" value = "<?php echo $booktitle; ?>" size="40"><br>
				<label for="C.ID"><p>Category:</p></label>
					<select id="C.ID" name="category_id">
					 	  <option value="1" <?= ($categoryid == "1")?"selected" : "" ?>>1-Periodical</option>
					      <option value="2" <?= ($categoryid == "2")?"selected" : "" ?>>2-English</option>
					      <option value="3" <?= ($categoryid == "3")?"selected" : "" ?>>3-Math</option>
					      <option value="4" <?= ($categoryid == "4")?"selected" : "" ?>>4-Science</option>
					      <option value="5" <?= ($categoryid == "5")?"selected" : "" ?>>5-Encyclopedia</option>
					      <option value="6" <?= ($categoryid == "6")?"selected" : "" ?>>6-Filipiniana</option>
					      <option value="7" <?= ($categoryid == "7")?"selected" : "" ?>>7-Newspaper</option>
					      <option value="8" <?= ($categoryid == "8")?"selected" : "" ?>>8-General</option>
					      <option value="9" <?= ($categoryid == "9")?"selected" : "" ?>>9-References</option>
				
					 	</select>
				<p>Author:</p>
				<input type="text" name="author" value = "<?php echo $author; ?>" size="40"><br>
				<p>Copies:</p>
				<input type="text" name="book_copies" value = "<?php echo $bookcopies; ?>" size="40"><br>
				<p>Pub:</p>
				<input type="text" name="book_pub" value = "<?php echo $bookpub; ?>" size="40"><br>
				<p>ISBN:</p>
				<input type="text" name="isbn" value = "<?php echo $isbn; ?>" size="40"><br>
				<p>Copyright Year:</p>
				<input type="text" name="copyright_year" value = "<?php echo $copyrightyear; ?>" size="40"><br>


					<p>Date Received:</p>
					<input type="datetime-local" step="1" name="date-received" value = "<?php echo $dater ; ?>" size="40">
					<p>Date Added:</p>
					<input type="datetime-local" step="1" name="date-added" value = "<?php echo $datea ; ?>" size="40">

					<label for="status"><p>Status:</p></label>
					<select id="status" name="status">
					 	  <option value="New" <?= ($status == "New")?"selected" : "" ?>>New</option>
					      <option value="Old" <?= ($status == "Old")?"selected" : "" ?>>Old</option>
					      <option value="Damaged" <?= ($status == "Damaged")?"selected" : "" ?>>Damaged</option>
					      <option value="Archive" <?= ($status == "Archive")?"selected" : "" ?>>Archive</option>
					      <option value="Lost" <?= ($status == "Lost")?"selected" : "" ?>>Lost</option>
					 	</select>
			
			
					<br>
				
				<a href="1ndex.php"><button id="registerButton" type="submit" name = "submit">Update</button></a>
			</form>
	</div>
</body>
</html>
