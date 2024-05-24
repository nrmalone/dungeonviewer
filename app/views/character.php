<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <?php if (isset($_SESSION['userID']) && ($data['pcs'] !== false)): ?>
        <div align="center" style="margin-top: 2vh;">
            <h2 style="margin: 0;"><?=$_SESSION['username']?>'s Characters</h2>
            <p style="margin: 0;"><?=count($data['pcs'])?>/10 character slots used.&emsp;<?php if (count($data['pcs']) < 10) { echo '<a href="character/createcharacter" style=" color: white; text-decoration: none; text-decoration: underline;">Create Character</a>'; } ?></p>
        </div>
        <?php foreach ($data['pcs'] as $character): ?>
            <div class="pcDiv" style="max-width: 100%; max-height: <?=(intval(100/(count($data['pcs']))))?>vh; padding-top: 10px; margin-top: 5%; border-bottom: 5px solid #6A0F0F;">
                <table style="display: inline; padding-left: 10px;">
                    <tr>
                        <td align="center"><h4 style="margin: 0; width: 8em;"><?=$character->pcName?></h4></td>
                        <td style="font-size: 10pt;">STR</td><td>&#9672;</td><td><?=$character->pcSTR?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-size: 10pt;">DEX</td><td>&#9672;</td><td><?=$character->pcDEX?></td>
                    </tr>
                    <tr>
                        <td style="display: inline;">Level <?=$character->pcLevel?></td>
                        <td style="font-size: 10pt;">CON</td><td>&#9672;</td><td><?=$character->pcCON?></td>
                    </tr>
                    <tr>
                        <td><?=$character->pcRace?></td>
                        <td style="font-size: 10pt;">INT</td><td>&#9672;</td><td><?=$character->pcINT?></td>
                    </tr>
                    <tr>
                        <td><?=$character->pcClass?></td>
                        <td style="font-size: 10pt;">WIS</td><td>&#9672;</td><td><?=$character->pcWIS?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-size: 10pt;">CHA</td><td>&#9672;</td><td><?=$character->pcCHA?></td>
                    </tr>
                    <tr>
                        <td align="center"><a href="<?=ROOT?>character/editcharacter/<?=$character->pcID?>" style="color: white; text-decoration: none; text-decoration: underline;">Edit Stats</a></td>
                    </tr>
                    <tr>
                    <td align="center"><a href="<?=ROOT?>character/deletecharacter/<?=$character->pcID?>" style="color: white; text-decoration: none; text-decoration: underline;">Delete</a></td>
                    </tr>
                </table>
                <table style="display: inline; padding: 0 10px 0 10px">
                    <tr>
                        <td align="center"><a href="<?=ROOT?>character/uploadavatar/<?=$character->pcID?>" style="color: white; text-decoration: none; text-decoration: underline;">Upload Avatar</a> &#9672; <a href="<?=ROOT?>character/modeler/<?=$character->pcID?>" style="color: white; text-decoration: none; text-decoration: underline;">Create Model</a></td>
                    </tr>
                    <tr>
                        <td align="left">
                            <img style="margin-left: 2em; border: solid black 3px; height: 15vh; object-fit: contain; border-radius: 15px 0 15px 0; display: inline; aspect-ratio: 1/1; object-fit: scale-down;"
                                src="<?=ROOT.'img/characters/pcs/user'.$_SESSION['userID'].'pc'.$character->pcID?>.png" onerror="this.onerror=null; src= '<?=ROOT.'img/characters/pcs/defaultpfp.jpg'?>'">
                        </td>
                    </tr>
                </table>
            </div>    
        <?php endforeach; ?>
    <?php else: ?>
        <h1>No characters to display</h1>
        <h2 align="center"><a href="<?=ROOT?>character/createcharacter" style="color: white; text-decoration: none; text-decoration: underline;">Create Character</a></h2>
    <?php endif; ?>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>