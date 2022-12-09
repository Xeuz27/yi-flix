<?php 
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/constants.php");

$detailsMessage = "";
$passwordMessage = "";

if(isset($_POST["saveDetailsButton"])){
    $account = new Account($con);
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

    if($account->updateDetails($firstName, $lastName, $email, $userLoggedIn)){
        $detailsMessage = "<div class='alertSuccess'>
                                Details updated successfuly!
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();
        $detailsMessage = "<div class='alertError'>
                                $errorMessage
                        </div>";
    }
}

if(isset($_POST["savePasswordButton"])){
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);
    

    if($account->updatePassword($oldPassword, $newPassword,$newPassword2, $userLoggedIn)){
        $passwordMessage = "<div class='alertSuccess'>
                                Password updated successfuly!
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();
        $passwordMessage = "<div class='alertError'>
                                $errorMessage
                        </div>";
    }
}
?>

<div class="settingsContainer column">
    <div class="formSection">
        <form method="POST">
            <h2>User Details</h2>
            <?php 
            $user = new User($con, $userLoggedIn);

            $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getfirstName();
            $lastName = isset($_POST["lastName"]) ? $_POST["firstName"] : $user->getlastName();
            $email = isset($_POST["email"]) ? $_POST["email"] : $user->getemail();
            
            ?>
            <input type="text" name="firstName" placeholder="first Name" value="<?php echo $firstName; ?>">
            <input type="text" name="lastName" placeholder="last Name" value="<?php echo $lastName; ?>">
            <input type="email" name="email" placeholder="Email"
            value="<?php echo $email; ?>">
            <div class="message">
                <?php echo $detailsMessage; ?>
            </div>
            <input type="submit" name="saveDetailsButton" value="save">
        </form>
    </div>
    <div class="formSection">
        <form method="POST">
            <h2>Update Password</h2>
            <input type="password" name="oldPassword" placeholder="old Password">
            <input type="password" name="newPassword" placeholder="new Password">
            <input type="password" name="newPassword2" placeholder="confirm New Password">
            <div class="message">
                <?php echo $passwordMessage; ?>
            </div>
            <input type="submit" name="savePasswordButton" value="save">
        </form>
    </div>
    <div class="formSection">
        <h2>Subscription</h2>
        
        <?php
        if($user->getIsSubscribed()){
            echo "<h3>You are subscribed! Go to Paypal to cancel.</h3>";
        }
        else {
            echo "<a href='billing.php' >Subscribe to Yi-Flix.</a>";
        }
        ?>
    </div>
</div>