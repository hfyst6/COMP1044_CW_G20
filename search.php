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
                    <input type="radio" id="books-option" name="optradio" value = "bk" checked><label class="text">Books</label>
               </label>
               <label class="radio-inline">
                     <input type="radio" id="members-option" name="optradio" value = "mb"><label class="text">Members</label>
               </label>
               <label class="radio-inline">
                    <input type="radio" id="borrow-option" name="optradio" value = "brw"><label class="text">Borrow Records</label>
               </label>
          </div>
     </form>
</body>
</html>