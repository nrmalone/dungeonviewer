<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Account info for <?= $_SESSION['username'] ?></h1>
    <div style="max-width: max-content;" class="accountDiv">
        <table style="display: flex;">
            <form method="POST">
                <tr align="center">
                    <td>Email: </td>
                    <td id="tdAcctInfoEmail"><p id="pAcctInfoEmail" style="display: inline;"><?= $_SESSION['email'] ?></p></td>
                    <td id="tdEmailButton"><button id="emailButton" class="accountButton" type="button" onclick="displayInput('email')">Edit</button></td>
                </tr>
                <tr align="center">
                    <td>Username:</td>
                    <td id="tdAcctInfoUsername"><p id="pAcctInfoUsername" style="display: inline;"><?= $_SESSION['username'] ?></p></td>
                    <td id="tdUsernameButton"><button id="usernameButton" class="accountButton" type="button" onclick="displayInput('username')">Edit</button></td>
                </tr>
                <tr align="center">
                    <td></td>
                    <td><a href="<?=ROOT?>account/deleteaccount"><button class="accountButton">Delete Account</button></a></td>
                    <td id="tdUpdateButton"><button id="updateSubmitButton" style="visibility: hidden;" class="accountButton" type="submit">Update</button></td>
                </tr>
            </form>
        </table>
    </div>
</div>

<script src="<?=ROOT?>js/accountUpdate.js"></script>