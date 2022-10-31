<?php
    if(isset($_POST["submitButton"])) {
        echo "form was submitted";
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
                <input type="text" placeholder="Username" name="userName" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="submit" value="SUBMIT" name="submitButton" >
            </form>

            <a href="register.php" class="signInMessage">Don't have an account? Sign Up here</a>
        </div>
    </div>
</body>
</html>