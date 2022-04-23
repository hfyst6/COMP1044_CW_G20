<?php
    session_start();
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
    $username = $password = "";
    $usernamealt = $passwordalt = $login_err = "";
    //if variable exist redirect to register page
    if (isset($_REQUEST['register'])) {
        $conn->close();
        header("Location: register.php");
    }
    //if variable exist start checking input
    if(isset($_REQUEST['login'])){
        //if username field is empty prompt message
        if(empty($_REQUEST['username'])){
            $usernamealt = "Please enter the username.";
        }else{ //capture username 
            $username = trim($_REQUEST['username']);
        }
        //if password field is empty prompt message
        if(empty($_REQUEST['password'])){
            $passwordalt = "Please enter your password.";
        }else{ //capture password
            $password = trim($_REQUEST['password']);
        }
        //if the variables is empty
        if((strlen($usernamealt)==0) && (strlen($passwordalt)==0)){
            $sql= "SELECT * FROM `users` WHERE `username`= '$username';";
            $result = $conn->query($sql); //execute sql

            if($result->num_rows > 0){ //if result more than 1 row
                $details = $result->fetch_assoc(); // fetch result
                $hash=$details['hashpassw']; //fetch hashpassw column

                if (password_verify($password,$hash)) { //compare password
                    session_start(); //start session
                    $_SESSION['username'] = $_POST['username'];
                    echo("<script language='javascript'>
                    window.alert('Log masuk berjaya.');
                    window.location.href='1ndex.php';</script>");

                    header("Location: 1ndex.php");
                } else { //else fill in variable
                    $login_err="Invalid username or password1.";
                }
            }else{ //else fill in variable
                $login_err="Invalid username or password2.";
            }
        } else { //else fill in variable
            $login_err="Invalid username or password3.";
        }
        $conn->close(); //close connection
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Loginn</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://kit.fontawesome.com/c272342684.js" crossorigin="anonymous"></script>
    <style>
        ::placeholder{
            color : red;
        }
        </style>
</head>
<body>
        <div class="card">
        <h1>Login</h1>
        <?php
        if(!empty($login_err)){
            echo '<span style="color : red">Invalid username or password.</span>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name = "username" placeholder="<?php echo (!empty($usernamealt)) ? $usernamealt : ''; ?>" />

                <label for="password">Password</label>
                <input type="password" id="password" name = "password" placeholder="<?php echo (!empty($passwordalt)) ? $passwordalt : ''; ?>" />

                <button type = "submit" name = "login" value = "login">Login</button>

                <a href="register.php">
                    <button class="alt" type = "submit" name = "register" value = "register">Sign Up Instead</button>
                </a>
        </form>
        
        </div>
        </div>
    </div>
</body>
</div>
</html>