<?php require_once '../app/components/pageheader.php'; ?>
<?php if ($data['pc'] !== false) : ?>
<!-- threejs -->
<?php else: ?>
<!-- display error about unable to load character -->
<div align="center" style="justify-content: center; max-width: max-content; margin: auto;">
    <h2>Whoops! Looks like that character doesn't exist yet.</h2>
    <h3>Want to <a href=<?=ROOT?><?php if (isset($_SESSION['userID'])) { echo "character"; } else { echo "account/signin"; } ?> style="color: white; text-decoration: none; text-decoration: underline;">make your own</a>?</h3>
</div>
<?php endif; ?>
<?php require_once '../app/components/pagefooter.php'; ?>