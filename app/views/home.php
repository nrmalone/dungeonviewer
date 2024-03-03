<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
}
unset($_SESSION['message']);
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Welcome to DND Viewer</h1>
    <h2>An unofficial interactive mapping tool<br>for Dungeons & Dragons campaigns</h2>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>