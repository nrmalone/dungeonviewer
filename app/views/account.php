<?php require_once '../app/components/pageheader.php'; ?>

<?php
if(isset($_SESSION['username'])) {
    require_once '../app/components/accountinfo.php';
} else {
    echo '
        <div style="justify-content: center; max-width: max-content; margin: auto;">
            <h2>Please <a style="text-decoration: none underline; color: #D5D5D5;" href="'. ROOT . 'account/signin">sign in</a> to view your account info</h2>
        </div>
    ';
}
?>

<?php require_once '../app/components/pagefooter.php'; ?>