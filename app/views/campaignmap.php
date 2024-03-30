<?php include_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<!-- https://phppot.com/php/simple-php-chat-using-websocket/
will test manually creating WebSockets w/ JS & PHP for handling w/ this tutorial -->
<?php include_once '../app/components/pagefooter.php'; ?>