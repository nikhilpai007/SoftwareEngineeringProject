<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT studentID, uname, password, Flag FROM users WHERE uname = ?";
        $stmt = "";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $flag);
                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){


                            // Store data in session variables
                            if($flag != 'C' ){
                              $_SESSION["loggedin"] = true;
                              $_SESSION["username"] = $username;
                              $_SESSION['flag'] = $flag;
                            } else if($flag == 'C' && $id != 0){
                              $_SESSION["loggedin"] = true;
                              $_SESSION['id'] = $id;
                              $_SESSION["username"] = $username;
                              $_SESSION['flag'] = $flag;
                            } else if($flag == 'C' && $id == 0){
                              echo '<script type="text/javascript">alert("No access. Contact an administrator to set your access");</script>';
                            }

                            // Redirect user to index.php
                            if($flag == "C" && $id != 0)
                              header("Location: studentIndex.php?id=".$id);
                            else if ($flag != "C")
                              header("Location: index.php");

                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>T.C.R.C - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.jpg"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
    <div class="limiter">
    <div class="container-login100" style="background-image: url('images/Login_background.jpg');">
			<div class="wrap-login100">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="wrap-input100 validate-input" data-validate = "Enter username" placeholder="Username" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
            <center><img src= "images/trent-community-research-centre LOGO.png" height = '80%' width = '80%'></center>
                <br>
              <center>  <h1> LOGIN </h1> </center>
              <br>
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="login100-form validate-form" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="login100-form validate-form">
             <center>  <input type="submit" class="btn btn-primary" value="Login"> </center>
            </div>
            <br>
            <h5>Don't have an account? <a href="register.php" style= "color:white">Sign up now</a>.</h5>
        </form>
        <?php/*
//LDAP Connection here

$ldap_dn = "uid=".$_POST["username"].",dc=example,dc=com";
$ldap_password = $_POST["password"];

$ldap_con = ldap_connect("192.168.xx.xx", 389"); //Add to your active directory protocol here
ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

if(ldap_bind($ldap_con,$ldap_dn,$ldap_password))
    echo "Authenticated";
else
    echo "Invalid Credential";
*/?>

    </div>
  </div>
</div>
</body>
</html>
