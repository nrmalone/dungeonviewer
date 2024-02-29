<?php require_once '../app/components/pageheader.php'; ?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1><?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; }?></h1>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>