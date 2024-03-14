<?php require_once '../app/components/pageheader.php'; ?>
<?php $character = (is_array($data['pc'])) ? $data['pc'][0] : false; ?>
<?php if (isset($_SESSION['userID']) && ($character->userID == $_SESSION['userID'])) : ?>
<!-- viewing your own character... threejs-powered modeler -->

<?php elseif (!is_bool($character)) : ?>
<!-- view other player's character... shows stats & avatar if exists -->
<h1 align="center">Meet <?=$character->pcName?>!</h1>
<div class="pcDiv" style="max-width: max-content; max-height: 50%; padding-top: 10px; margin-top: 2%; border-bottom: 5px solid #6A0F0F; margin-left: auto; margin-right: auto;">
    <table style="display: inline; padding-left: 10px; font-size: 14pt;">
        <tr>
            <td align="center">Level <?=$character->pcLevel?></td>
        </tr>
        <tr>
            <td align="center"><?=$character->pcRace?></td>
        </tr>
        <tr>
            <td align="center"><?=$character->pcClass?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="right">Strength</td>
            <td>&#9672;</td>
            <td align="center"><?=$character->pcSTR?></td>
        </tr>
        <tr>
            <td align="right">Dexterity</td>
            <td>&#9672;</td>
            <td align="center"><?=$character->pcDEX?></td>
        </tr>
        <tr>
            <td align="right">Constitution</td>
            <td>&#9672;</td>
            <td align="center"><?=$character->pcCON?></td>
        </tr>
        <tr>
            <td align="right">Intelligence</td>
            <td>&#9672;</td>
            <td align="center"><?=$character->pcINT?></td>
        </tr>
        <tr>
            <td align="right">Wisdom</td>
            <td>&#9672;</td>
            <td align="center"><?=$character->pcWIS?></td>
        </tr>
        <tr>
            <td align="right">Charisma</td>
            <td>&#9672;</td>
            <td align="center"><?=$character->pcDEX?></td>
        </tr>
    </table>
    <table style="display: inline; padding: 0 10px 0 10px">
        <tr>
            <td align="center"></td>
        </tr>
        <tr>
            <td><img style="margin-left: 2.5%; width: 30vw; border: solid black 3px;  border-radius: 15px 0 15px 0; display: inline; aspect-ratio: 1/1; object-fit: cover;" src="<?php
                $charImgFolder = ROOT . 'img/characters/';
                $imgpath = $charImgFolder . 'u' . $character->userID . 'p' . $character->pcID . '.png';
                if (file_exists($imgpath)) { echo $imgpath; } else { echo $charImgFolder . 'defaultPC.png'; } ?>"></td>
        </tr>
    </table>
    <p align="center" style="width: 80%; margin-left: auto; margin-right: auto; margin-top: 10px; margin-bottom: 2%;"><em>backstory placeholder</em></p>
</div>
<h3 align="center">Want to <a href=<?=ROOT?><?php if (isset($_SESSION['userID'])) { echo "character"; } else { echo "account/signin"; } ?> style="color: white; text-decoration: none; text-decoration: underline;">make your own</a>?</h3>
<?php else: ?>
<!-- display error about unable to load character -->
<div align="center" style="justify-content: center; max-width: max-content; margin: auto;">
    <h2>Whoops! Looks like that character doesn't exist yet.</h2>
    <h3>Want to <a href=<?=ROOT?><?php if (isset($_SESSION['userID'])) { echo "character"; } else { echo "account/signin"; } ?> style="color: white; text-decoration: none; text-decoration: underline;">make your own</a>?</h3>
</div>
<?php endif; ?>
<?php require_once '../app/components/pagefooter.php'; ?>