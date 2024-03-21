<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Account Creation</h1>
    <div class="accountDiv" style="max-width: 100%; max-height: max-content;">
        <table style="display: flex;">        
            <form method="POST">
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Username: </p></td>
                    <td><input name="username" class="textField" type="text" maxlength="16" required></td>
                </tr>
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Email: </p></td>
                    <td><input name="email" class="textField" type="email" maxlength="100" required></td>
                </tr>
                <tr align="center">
                    <td><p style="display: inline; width: 25%;">Password: </p></td>
                    <td><input name="password" class="textField" type="password" maxlength="255" required></td>
                </tr>
                <tr align="center">
                    <td><h5>*Username must be 4-16<br>
                            alphanumeric characters.<br>
                            Password cannot contain:<br>
                            \ &nbsp; / &nbsp; ' &nbsp; " &nbsp; , &nbsp; < &nbsp; > &nbsp; ! &nbsp; &
                    </h5></td>
                    <td><button class="accountButton" type="submit">Submit</button></td>
                </tr>
            </form>
        </table>
    </div>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>