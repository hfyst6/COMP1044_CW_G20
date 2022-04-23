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
    //create empty variables
    $username = $password = $confirm_password = "";
    $usernamealt = $passwordalt = $confirm_password_err = "";
    //if variable exist start checking input
    if (isset($_POST["register"])) {
        if(empty($_REQUEST['username'])){ //if username field is empty display error message
            $usernamealt = "Please enter a username.";
        }else{ //else capture username 
            $username = $_REQUEST['username'];
            $sql = "SELECT * FROM `users` WHERE `username`= '$username';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) { //if username is found in the table display error message
                $usernamealt="The username is already registered!";
            }
        }
        //if password field is empty display error message
        if(empty($_REQUEST['password'])){
            $passwordalt = "Please enter a password.";
        }else if (strlen($_REQUEST['password'])< 4){ //else if password is less than 4 characters display error message
            $passwordalt = "Password must have atleast 4 characters.";
        }else {
            $password = $_REQUEST['password']; //else capture password
        }
        //if password confirmation field is empty display error message
        if(empty($_POST["confirm_password"])){
            $confirm_password_err = "Please confirm password.";     
        } else{ //else capture password
            $confirm_password = $_REQUEST["confirm_password"];
            if(empty($passwordalt) && ($password != $confirm_password)){ //if they are not matched display error message
                $confirm_password_err = "Password did not match.";
            }
        }
        //if error message variable is empty execute sql insert 
        if((strlen($usernamealt)==0) && (strlen($passwordalt)==0) && (strlen($confirm_password_err)==0)){
            $userid = NULL;
            $firstname = $_REQUEST['firstname'];
            $lastname = $_REQUEST['lastname']; //capture inputs
            $passwordhash = password_hash($password, PASSWORD_DEFAULT); //hash password using hashing algorithm
            //prepare statement and bind parameters
            $sql = $conn->prepare("INSERT INTO `users` (`user_id`,`username`,`password`, `hashpassw`,`firstname`, `lastname`) VALUES ( ?,?,?,?,?,?);");
            $sql->bind_param("isssss", $userid, $username,$password, $passwordhash, $firstname, $lastname);
            $sql->execute(); //execute sql
            $sql->close();
            $conn->close(); //close statement and connection
            header("Location: auth.php");
        }
    }
    //if variable exist redirect to login page
    if (isset($_POST['login'])) {
        $conn->close();
        header("Location: auth.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://kit.fontawesome.com/c272342684.js" crossorigin="anonymous"></script>
    <style>
        ::placeholder{
            color: red;
        }
    </style>
</head>
<body>
        <div class="card">
        <h1>Sign Up</h1>
        <form action = "register.php" method = "post">
                <label for="fname">First Name</label>
                <input type="fname" id="fname" name = "firstname" />

                <label for="lname">Last Name</label>
                <input type="lname" id="lname" name = "lastname" />

                <label for="username">Username</label>
                <input type="text" id="username" name = "username" placeholder="<?php echo ((!empty($usernamealt)) ? $usernamealt : ''); ?>"/>

                <label for="password">Password</label>
                <input type="password" id="password" name = "password" placeholder="<?php echo (!empty($passwordalt)) ? $passwordalt : ''; ?>"/>

                <label for="password"> Confirm Password</label>
                <input type="password" id="password" name = "confirm_password" placeholder="<?php echo (!empty($confirm_password_err)) ? $confirm_password_err : ''; ?>"/>

                <button type = "submit" name = "register" value = "register">Sign Up</button>

            <a href="auth.html">
                 <button class="alt" type = "submit" name = "login" value = "login">Login Instead</button>
            </a>
        </form>
        
        </div>
        </div>
    </div>
</body>
</div>
</html>