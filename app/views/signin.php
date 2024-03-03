<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Account Sign-in</h1>
    <div class="accountDiv" style="max-width: 100%; max-height: max-content;">
        <table style="display: flex;">    
            <form method="POST">
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Username: </p></td>
                    <td><input name="username" class="textField" type="text" required></td>
                </tr>
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Password: </p></td>
                    <td><input name="password" class="textField" type="password" required></td>
                </tr>
                <tr align="center">
                    <td></td><td><button class="accountButton" type="submit">Submit</button></td>
                </tr>
            </form>
            <tr align="center">
                <td></td><td><a class="headerLink" href="<?= ROOT?>account/forgotpassword">Forgot password?</a></td>
            </tr>
        </table>
    </div>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>