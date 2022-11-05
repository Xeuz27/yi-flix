<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["userName"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

        $success = $account->validate($firstName, $lastName, $username, $email, $email2, $password, $password2);
        
        if($success) {
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }
    public function getInputValue($name){
        if(isset($_POST($name)) {
            echo $_POST[$name];
        })
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
                <h3>Sign Up</h3>
                <span>to continue to Yi-flix</span>
            </div>

            <form method="POST">
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" placeholder="First name" name="firstName" value="<?php getInputValue("firstName"); ?>" required>

                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" placeholder="Last name" name="lastName" value="<?php getInputValue("lastName"); ?>" required>

                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" placeholder="Username" name="userName" value="<?php getInputValue("username"); ?>" required>

                <?php echo $account->getError(Constants::$emailNotValid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" placeholder="Email" name="email" value="<?php getInputValue("email"); ?>" required>
                
                <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                <input type="email" placeholder="Confirm Email" name="email2" value="<?php getInputValue("email2"); ?>" required>
                
                <?php echo $account->getError(Constants::$passwordsLength); ?>
                <input type="password" placeholder="Password" name="password" required>
                
                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <input type="password" placeholder="Confirm Password" name="password2" required>

                <input type="submit" value="SUBMIT" name="submitButton" >
            </form>

            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
            
        </div>

    </div>

</body>
</html>