<?php include_once '../app/components/pageheader.php'; ?>
<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>
<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1 align="center">Campaign Creation</h1>
    <?php if (isset($_SESSION['userID']) && is_array($data['campaign'])): ?>
        <?php $campaign = $data['campaign'][0]; ?>
        <div class="campaignDiv" style="max-width: max-content; padding: 5px 5px 5px 5px;">
            <form method="POST">        
                <table style="display: flex;">
                    <input type="hidden" name="campaignID" value="<?=$campaign->campaignID?>">
                    <button type="submit" disabled style="display: none;"></button>
                    <tr>
                        <td align="right">Campaign Name:</td>
                        <td><input name="name" class="textField" type="text" maxlength="16" value="<?=$campaign->campaignName?>" required></td>
                    </tr>
                    <tr>
                        <td align="right">Password:</td>
                        <td><input name="password" class="textField" type="password" maxlength="255" required value="<?=$campaign->campaignPassword?>" id="password"></td>
                        <td><button type="button" style="color: white; border: none; background: #B51A1A" onclick="togglePW()">&#128065;</button></td>
                    </tr>
                    <tr>
                        <td align="right">Backstory:</td>
                        <td><input type="textarea" name="backstory" class="textField" style="padding-bottom: 4em;"disabled></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center"><button type="submit" class="accountButton">Submit</button></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
        <script type="text/javascript">
            function togglePW() {
                var pw = document.getElementById('password');
                if (pw.type === "password") {
                    pw.type = "text";
                } else {
                    pw.type = "password";
            }
        }
        </script>
    <?php else: ?>
        <h3 align="center">Please <a href="<?=ROOT?>account/signin" class="defaultLink">sign in</a> to view your campaigns.</h3>
    <?php endif; ?>
</div>
<?php include_once '../app/components/pagefooter.php'; ?>