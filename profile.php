<?php 
require_once("includes/headerphp");
if(isset($_POST["saveDetailsButton"])){
    $account = new Account($con);
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
}
?>

<div class="settingsContainer column">
    <div class="formSection">
        <form method="POST">
            <h2>User Details</h2>
            <?php 
            $user = new User($con, $userLoggedIN);

            $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getfirstName();
            $lastName = isset($_POST["lastName"]) ? $_POST["firstName"] : $user->getlastName();
            $email = isset($_POST["email"]) ? $_POST["email"] : $user->getemail();
            
            ?>
            <input type="text" name="firstName" placeholder="first Name" value="<?php echo $firstname; ?>">
            <input type="text" name="lastName" placeholder="last Name" value="<?php echo $lastname; ?>">
            <input type="email" name="email" placeholder="Email"
            value="<?php echo $email; ?>">

            <input type="submit" name="saveDetailsButton" value="save">
        </form>
    </div>
    <div class="formSection">
        <form method="POST">
            <h2>Update Password</h2>
            <input type="password" name="oldPassword" placeholder="old Password">
            <input type="password" name="newPassword" placeholder="new Password">
            <input type="password" name="newPassword2" placeholder="confirm New Password">

            <input type="submit" name="savePasswordButton" value="save">
        </form>
    </div>
</div>