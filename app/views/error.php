<?php require_once '../app/components/pageheader.php'; ?>

<div style="margin-top: 5%;">
    <h1>Whoops, something's wrong. Roll an Insight check for breakfix...</h1>

    <?php if (isset($_SESSION['error'])) {
        echo '<pre>';
        echo $_SESSION['error'];
        echo '</pre>';
    }
    ?>
</div>

<?php require_once '../app/components/pagefooter.php';