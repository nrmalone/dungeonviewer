<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Testing chat functionality</h1>
    <form method='POST'>
        <table>
            <tr>
                <td><label>Enter Message</label>
                <input type="text" name="txtMessage">
                <input type="submit" name="btnSend" = value="Send">
            </tr>
            <?php
                $host = "127.0.0.1";
                $port= 8090;

                if (isset($_POST['btnSend'])) {
                    $msg = sanitize($_REQUEST['txtMessage']);
                    $sock = socket_create(AF_INET, SOCK_STREAM, 0);
                    socket_connect($sock, $host, $port);

                    socket_write($sock, $msg, strlen($msg));

                    $reply = socket_read($sock, 1924);
                    $reply = trim($reply);
                    $reply = "Server says:\t".$reply;
                }
            ?>
            <tr>
                <td>
                    <textarea rows="10" cols="30"><?php echo @$reply; ?></textarea>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>