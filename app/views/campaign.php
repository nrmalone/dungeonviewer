<?php include_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div align="center" style="justify-content: center; max-width: max-content; margin: auto;">
    <h1>Campaigns</h1>
    <?php if (isset($_SESSION['userID'])) : ?>
        <!-- display hosted campaigns -->
        <div class="campaignDiv">
            <h2>Hosted</h2>
            <?php if ($data['campaignsHosted'] != false) : ?>
                <p>test <?=$data['campaignsHosted']?></p>

            <?php else: ?>
                <h3>No hosted campaigns to display.</h3>                
            <?php endif; ?>
        </div>

        <!-- display played campaigns -->
        <div class="campaignDiv">
            <h2>Played</h2>
            <?php if ($data['campaignsPlayed']['campaigns'] != false) : ?>

            <?php else: ?>
                <h3>No played campaigns to display.</h3>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <h2><a href="<?=ROOT?>account/signin" style="color: white; text-decoration: none; text-decoration: underline;">Sign-in</a> to view your campaigns.</h2>
    <?php endif; ?>
</div>

<?php include_once '../app/components/pagefooter.php'; ?>