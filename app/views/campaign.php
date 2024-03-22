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
        <div class="campaignDiv" style="vertical-align: top;">
            <h2>Hosted</h2>
            <?php if ($data['campaignsHosted'] != false) : ?>
                <?php if (count($data['campaignsHosted']) < 10) { echo '<h3><a href="' . ROOT . 'campaign/createcampaign" style="color: white; text-decoration: none; text-decoration: underline;">Create a campaign</a></h3>'; } ?>
                <?php foreach ($data['campaignsHosted'] as $campaign): ?>
                    <div class="campaignCard" style="margin-bottom: 0.5em;">
                        <h3 style="margin: 0.5em 0 0.5em 0;"><?=$campaign->campaignName?></h3>
                        <h4 style="display: inline;">Join Info: <span style="padding-right: 5px; display: none; color: #B51A1A" id="show<?=$campaign->campaignID?>">ID: <?=$campaign->campaignID?>, Password: <?=$campaign->campaignPassword?></span></h4><button class="campaignButton" style="display: inline;" type="button" onclick="toggleHide('show<?=$campaign->campaignID?>')">Show/Hide</button>
                        <h5 style="margin: 0.5em 0 0.5em 0;">
                            <a class="defaultLink" style="margin-right: 2em;" href="<?=ROOT?>campaign/host/<?=$campaign->campaignID?>">Host</a>
                            <a class="defaultLink" style="margin-right: 2em;" href="<?=ROOT?>campaign/editcampaign/<?=$campaign->campaignID?>">Edit</a>
                            <a class="defaultLink" href="<?=ROOT?>campaign/deletecampaign/<?=$campaign->campaignID?>">Delete</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="campaignCard">
                    <h3>No hosted campaigns to display.</h3>
                    <h3><a href="<?=ROOT?>campaign/createcampaign" style="color: white; text-decoration: none; text-decoration: underline;">Create a campaign</a></h3>
                </div>
            <?php endif; ?>
        </div>
        <script type="text/javascript">
            function toggleHide(info) {
                var infoDisplay = document.getElementById(info);
                if (infoDisplay.style.display === "none") {
                    infoDisplay.style.display = "inline";
                } else {
                    infoDisplay.style.display = "none";
                }
            }
        </script>

        <!-- display played campaigns -->
        <div class="campaignDiv" style="vertical-align: top;">
            <h2>Played</h2>
            <?php if ($data['campaignsPlayed']['campaigns'] != false) : ?>
                <?php if (count($data['campaignsPlayed']['campaigns']) < 10) { echo '<h3><a href="' . ROOT . 'campaign/joincampaign" style="color: white; text-decoration: none; text-decoration: underline;">Join a campaign</a></h3>'; } ?>
                <?php foreach ($data['campaignsPlayed'] as $infoHolder): ?>
                    <?php
                        $pcCampaign = $infoHolder['campaigns'];
                        $pc = $infoHolder['pcs'];
                    ?>
                    <div class="campaignCard">
                        <span><h3 style="display: inline;"><?=$pcCampaign->campaignName?></h3><h5 style="display: inline;">&nbsp;(playing as <?=$pc->pcName?>)</h5></span>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <div class="campaignCard">
                    <h3>No played campaigns to display.</h3>
                    <h3><a href="<?=ROOT?>campaign/joincampaign" style="color: white; text-decoration: none; text-decoration: underline;">Join a campaign</a></h3>
                </div>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <h2><a href="<?=ROOT?>account/signin" style="color: white; text-decoration: none; text-decoration: underline;">Sign-in</a> to view your campaigns.</h2>
    <?php endif; ?>
</div>

<?php include_once '../app/components/pagefooter.php'; ?>