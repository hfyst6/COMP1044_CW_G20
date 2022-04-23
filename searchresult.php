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
     //if variable exist start searching
     if(isset($_POST['submit'])){ 
          $search=$_REQUEST['search'];
          $choice=$_REQUEST['optradio']; //capture inputs
          
          switch($choice){
               case "bk": //if user select book field
                    $sql = "SELECT * FROM `book` WHERE `book_id` LIKE '%$search%' OR `book_title` LIKE '%$search%' OR `category_id` LIKE '%$search%' OR 
                    `author` LIKE '%$search%' OR `book_copies` LIKE '%$search%' OR `book_pub` LIKE '%$search%' OR `isbn` LIKE '%$search%' OR 
                    `copyright_year` LIKE '%$search%' OR `date_receive` LIKE '%$search%' OR `date_added` LIKE '%$search%' OR `status` LIKE '%$search%';";
                    $result = $conn->query($sql);
                    $conn->close();
                    break;

               case "mb": //if user select member field
                    $sql = "SELECT * FROM `member` WHERE `member_id` LIKE '%$search%' OR `firstname` LIKE '%$search%' OR `lastname` LIKE '%$search%' OR 
                    `gender` LIKE '%$search%' OR `address` LIKE '%$search%' OR `contact` LIKE '%$search%' OR `type_id` LIKE '%$search%' OR `year_level` LIKE '%$search%' OR
                    `status` LIKE '%$search%';";
                    $result = $conn->query($sql);
                    $conn->close();
                    break;

               case "brw": //if user select borrow record field
                    $sql = "SELECT * FROM `borrowdetails` AS bd, `borrow` AS b WHERE bd.borrow_id=b.borrow_id AND ( bd.book_id LIKE '%$search%' OR 
                    b.borrow_id LIKE '%$search%' OR b.member_id LIKE '%$search%' OR b.date_borrow LIKE '%$search%' OR b.due_date LIKE '%$search%' OR 
                    bd.borrow_status LIKE '%$search%' OR bd.date_return LIKE '%$search%');";
                    $result = $conn->query($sql);
                    $conn->close();
                    break;

               default: //if none 
                    $conn->close();
                    header("Location: search.php");
                    break;
          }
     }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
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

     <div class="top">
          <h1><b>Search</b></h1>
     </div>	
     <form action = "searchresult.php" method = post>
          <div class="searchbar">
               <input type="search" placeholder="Start Searching..." name = "search">
               <a href="searchresult.php"><button type="submit" name ="submit"><span class="fas fa-search"></span></button></a>
          </div>

          <div class="search-option">
               <p>Choose a table to search from:</p>
               <label class="radio-inline">
                    <input type="radio" id="books-option" name="optradio" value = "bk"><label class="text">Books</label>
               </label>
               <label class="radio-inline">
                     <input type="radio" id="members-option" name="optradio" value = "mb"><label class="text">Members</label>
               </label>
               <label class="radio-inline">
                    <input type="radio" id="borrow-option" name="optradio" value = "brw"><label class="text">Borrow Records</label>
               </label>
          </div>
     </form>
     <table class="table">
     <?php
          switch($choice){
               case "bk" :
     ?>
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
                    </tr>
          <?php 
               }
               break; 
          ?>
     <?php
          case "mb" :
     ?>
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
                    </tr>
          <?php     
               }
               break;
          ?>
     <?php
          case "brw" :
     ?>
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
                    </tr>
          <?php
               }
               break;
          ?>
     <?php
          }
     ?>
     </table>

</body>
</html>