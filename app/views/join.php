<?php include_once '../app/components/pageheader.php'; ?>
<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <h1 align="center">Campaign Joining</h1>
    <?php if (isset($_SESSION['userID']) && $data['pcs'] != false): ?>
        <form method="POST">
            <button type="submit" disabled style="display: none;"></button>
            <div class="campaignDiv" style="max-width: max-content; padding: 5px 5px 5px 5px; margin: auto; display: block;">
                <table style="display: block;">
                        <tr align="center">
                            <td align="right">Join ID:</td>
                            <td><input id="joinID" name="joinID" class="textField" type="text" maxlength="16" required></td>
                        </tr>
                        <tr>
                            <td align="right">Campaign Password:</td>
                            <td><input id="password" name="password" class="textField" type="password" maxlength="255" required></td>
                            <td><button type="button" style="color: white; border: none; background: #B51A1A" onclick="togglePW()">&#128065;</button></td>
                        </tr>
                </table>
            </div>

            <h3>Available characters:</h3>
            <?php foreach($data['pcs'] as $character): ?>
                <?php if ($character === $data['pcs'][0]) : ?>
                    <div class="pcDiv" style="width: 80vw; margin: 0.5em 0 0.5em 0; padding: 0.5em 0.25em 0.25em 0.25em;">
                        <input id="pc<?=$character->pcID?>" type="radio" name="pcID" value="<?=$character->pcID?>" checked><label for="pc<?=$character->pcID?>"><span style="font-size: 14pt; font-weight: bold;"><?=$character->pcName?></span>&emsp;<p align="right" style="display: inline;">Lvl <?=$character->pcLevel?>&nbsp;<?=$character->pcRace?>&nbsp;<?=$character->pcClass?>&nbsp;<span style="color: #6A0F0F; font-weight: bold;">&#9672;</span> HP: <?=$character->pcHP?> AC: <?=$character->pcAC?> <span style="color: #6A0F0F; font-weight: bold;">&#9672;</span> STR: <?=$character->pcSTR?> | DEX: <?=$character->pcDEX?> | CON: <?=$character->pcCON?> | INT: <?=$character->pcINT?> | WIS: <?=$character->pcWIS?> | CHA: <?=$character->pcCHA?></p></label>
                    </div>
                <?php else: ?>
                    <div class="pcDiv" style="width: 80vw; margin: 0.5em 0 0.5em 0; padding: 0.5em 0.25em 0.25em 0.25em;">
                        <input id="pc<?=$character->pcID?>" type="radio" name="pcID" value="<?=$character->pcID?>"><label for="pc<?=$character->pcID?>"><span style="font-size: 14pt; font-weight: bold;"><?=$character->pcName?></span>&emsp;<p align="right" style="display: inline;">Lvl <?=$character->pcLevel?>&nbsp;<?=$character->pcRace?>&nbsp;<?=$character->pcClass?>&nbsp;<span style="color: #6A0F0F; font-weight: bold;">&#9672;</span> HP: <?=$character->pcHP?> AC: <?=$character->pcAC?> <span style="color: #6A0F0F; font-weight: bold;">&#9672;</span> STR: <?=$character->pcSTR?> | DEX: <?=$character->pcDEX?> | CON: <?=$character->pcCON?> | INT: <?=$character->pcINT?> | WIS: <?=$character->pcWIS?> | CHA: <?=$character->pcCHA?></p></label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div align="center">
                <button type="submit" class="campaignButton" style="font-size: 16pt; margin: 0.5em 0 0.5em 0;">Submit</button>
            </div>
        </form>

    <?php elseif (isset($_SESSION['userID']) && $data['pcs'] == false): ?>
        <h3 align="center">No available characters to join campaigns.</h3>
        <h5 align="center"><a href="<?=ROOT?>campaign" class="defaultLink">← Back to Campaigns menu</a></h5>
        <h5 align="center"><a href="<?=ROOT?>character/createcharacter" class="defaultLink">→ Create a character</a></h5>
    <?php else: ?>
        <h3 align="center">Please <a href="<?=ROOT?>account/signin" class="defaultLink">sign in</a> to join a campaign.</h3>
    <?php endif; ?>
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
<?php include_once '../app/components/pagefooter.php'; ?>