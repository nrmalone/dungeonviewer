<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Account info for <?= $_SESSION['username'] ?></h1>
    <div style="max-width: max-content;" class="accountDiv">
        <table style="display: flex;">

            <? //updateemail ?>
            <?php if (str_contains($_SERVER['REQUEST_URI'], 'updateemail') && !str_contains($_SERVER['REQUEST_URI'], 'updateusername')): ?>
            <form method="POST">
            <tr align="center">
                    <td>Current Email:</td>
                    <td><p id="pAcctInfoUsername" style="display: inline;"><?= $_SESSION['email'] ?></p></td>
                    <td><a href="<?=ROOT?>account"><button class="accountButton" type="button">Cancel</button></a></td>
                </tr>
                <tr align="center">
                    <td>New Email:</td>
                    <td><input class="textField" name="email" type="email" value="<?=$_SESSION['email']?>" required></td>
                    <td></td>
                </tr>
                <tr align="center">
                    <td></td>
                    <td><button class="accountButton" type="submit">Update</button></a></td>
                    <td></td>
                </tr>
            </form>

            <? //updateusername ?>
            <?php elseif (str_contains($_SERVER['REQUEST_URI'], 'updateusername') && !str_contains($_SERVER['REQUEST_URI'], 'updateemail')): ?>
                <form method="POST">
                <tr align="center">
                    <td>Current Username:</td>
                    <td><p id="pAcctInfoUsername" style="display: inline;"><?= $_SESSION['username'] ?></p></td>
                    <td><a href="<?=ROOT?>account"><button class="accountButton" type="button">Cancel</button></a></td>
                </tr>
                <tr align="center">
                    <td>New Username:</td>
                    <td><input class="textField" name="username" type="text" value="<?=$_SESSION['username']?>" required></td>
                    <td></td>
                </tr>
                <tr align="center">
                    <td></td>
                    <td><button class="accountButton" type="submit">Update</button></td>
                    <td></td>
                </tr>
            </form>

            <? //deleteaccount ?>
            <?php elseif (str_contains($_SERVER['REQUEST_URI'], 'deleteaccount') && (!str_contains($_SERVER['REQUEST_URI'], 'updateemail') || !str_contains($_SERVER['REQUEST_URI'], 'updateusername'))): ?>
                <form method="POST">
                <tr align="center">
                    <td>Confirm Username:</td>
                    <td><input class="textField" name="username" type="text" required></td>
                    <td><a href="<?=ROOT?>account"><button class="accountButton" type="button">Cancel</button></a></td>
                </tr>
                <tr align="center">
                    <td>Password:</td>
                    <td><input class="textField" name="password" type="password" required></td>
                    <td></td>
                </tr>
                <tr align="center">
                    <td></td>
                    <td><button class="accountButton" type="submit">Delete Account</button></td>
                    <td></td>
                </tr>
            </form>

            <? //default account info page ?>
            <?php else: ?>
                <tr align="center">
                    <td>Email:</td>
                    <td><p id="pAcctInfoEmail" style="display: inline;"><?= $_SESSION['email'] ?></p></td>
                    <td><a href="<?=ROOT?>account/updateemail"><button class="accountButton" type="button">Edit</button></a></td>
                </tr>
                <tr align="center">
                    <td>Username:</td>
                    <td><p id="pAcctInfoUsername" style="display: inline;"><?= $_SESSION['username'] ?></p></td>
                    <td><a href="<?=ROOT?>account/updateusername"><button class="accountButton" type="button">Edit</button></a></td>
                </tr>
                <tr align="center">
                    <td></td>
                    <td><a href="<?=ROOT?>account/deleteaccount"><button class="accountButton">Delete Account</button></a></td>
                    <td></td>
                </tr>

            <?php endif; ?>
        </table>
    </div>
</div>