<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);
     if(isset($_POST["submitButton"])) {
        $username = FormSanitizer::sanitizeFormUsername($_POST["userName"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        

        $success = $account->login($username, $password);
        
        if($success) {
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }

    function getInputValue($name){
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yi-flix | netflix clone for educational purposes</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
</head>
<body>
    <div class='signInContainer'>
        <div class="column">
            <div>
                <img class="logo" src="./assets/img/yiflix-logo.png" alt="netflix-font" border="0">
                <h3>Sign In</h3>
                <span>to continue to Yi-flix</span>
            </div>
            <form method="POST">
            <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" placeholder="Username" name="userName" value="<?php getInputValue("username"); ?>" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="submit" value="SUBMIT" name="submitButton" >
            </form>

            <a href="register.php" class="signInMessage">Don't have an account? Sign Up here</a>
        </div>
    </div>
</body>
</html>