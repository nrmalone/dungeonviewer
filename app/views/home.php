<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Welcome to DND Viewer</h1>
    <h2>An unofficial character sheet and<br>mapping tool for tabletop RPGs</h2>

    <h4>Compatible with fifth edition D&D under the <a style="color: white; text-decoration: none; text-decoration: underline;"href="https://creativecommons.org/licenses/by/4.0/legalcode" target="_blank">CC-BY-4.0</a><br>licensing of <a style="color: white; text-decoration: none; text-decoration: underline;" href="https://dnd.wizards.com/resources/systems-reference-document" target="_blank">D&D 5E</a> by Wizards of the Coast LLC</h4>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>