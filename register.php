<?php
require_once("includes/classes/FormSanitizer.php")
    if(isset($_POST["submitButton"])) {
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"])
    };
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
                <input type="text" placeholder="First name" name="firstName" required>
                <input type="text" placeholder="Last name" name="lastName" required>
                <input type="text" placeholder="Username" name="userName" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="email" placeholder="Confirm Email" name="email2" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="password2" required>
                <input type="submit" value="SUBMIT" name="submitButton" >
            </form>

            <a href="login.php" class="signInMessage">Already have an account? Sign in</a>
        </div>
    </div>
</body>
</html>