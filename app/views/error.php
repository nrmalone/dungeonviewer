<?php require_once '../app/components/pageheader.php'; ?>

<h1>Whoops, something's wrong. Roll an Insight check for breakfix...</h1>

<?php if (isset($_SESSION['error'])) {
    echo '<pre>';
    echo $_SESSION['error'];
    echo '</pre>';
}
?>

<?php require_once '../app/components/pagefooter.php';